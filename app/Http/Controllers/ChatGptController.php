<?php

namespace App\Http\Controllers;

use App\Models\ChatGpt;
use App\Models\DailyUserTokens;
use App\Models\History;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ChatGptController extends Controller
{
    public function GetPost(Request $request)
    {
        try {
            // if ($request->variations == "3") {
            //     $variationsCount = 3;
            // } elseif ($request->variations == "2") {
            //     $variationsCount = 2;
            // } elseif ($request->variations == "1") {
            //     $variationsCount = 1;
            // } else {
            //     $variationsCount = 1;
            // }
            $variationsCount = 1;
            $promptToken = ChatGpt::where('id', 1)->first();
            $totalPromptToken = $promptToken->prompt_tokens * $variationsCount;
            $userToken = User::where('id', Auth::user()->id)->first();
            if ($userToken->lastTokens < $totalPromptToken) {
                return redirect()->back()->with('error', 'Your current tokens are less than required.');
            }
            $results = [];
            for ($i = 0; $i < $variationsCount; $i++) {

                if ($request->type == "social-media-ad-copy-creation") {
                    $prompt = $this->getSocialMediaPrompt($request);
                }
                if ($request->type == "email-copy-creation") {
                    $prompt = $this->getEmailPrompt($request);
                }
                $tokenData = ChatGpt::where('id', 1)->first();
                $api_key = $tokenData->token;
                $url = "https://api.openai.com/v1/completions";

                $data = [
                    "model" => "gpt-3.5-turbo-instruct",
                    "prompt" => $prompt,
                    "max_tokens" => intval($promptToken->prompt_tokens),
                    "temperature" => 0
                ];
                $data_json = json_encode($data);
                $headers = [
                    "Content-Type: application/json",
                    "Authorization: Bearer " . $api_key
                ];
                $ch = curl_init($url);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
                curl_setopt($ch, CURLOPT_POSTFIELDS, $data_json);
                curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
                $response = curl_exec($ch);
                $sampleResult = json_decode($response, true);
                if (@$sampleResult['error']['message']) {
                    return redirect()->back()->with('error', $sampleResult['error']['message']);
                }
                $results[] = $sampleResult; // Add the result to the results array
            }
            if ($request->type == "social-media-ad-copy-creation") {
                $promptInput = [
                    "brand" => @$request->brand,
                    "desc_brand" => @$request->desc_brand,
                    "better_brand" => @$request->better_brand,
                    "type" => "social-media-ad-copy-creation",
                    "lang" => @$request->lang,
                ];
            }
            if ($request->type == "email-copy-creation") {
                $promptInput = [
                    "brand" => @$request->brand,
                    "desc_brand" => @$request->desc_brand,
                    "better_brand" => @$request->better_brand,
                    "type" => "email-copy-creation",
                    "lang" => @$request->lang,
                    "date_type" => @$request->date_type,
                    "end_date" => @$request->end_date,
                ];
            }
            $history = new History();
            $history->user_id = Auth::user()->id;
            $history->prompt = $promptInput;
            $history->response = $results;
            $history->save();
            $totalTokens = 0;
            foreach ($results as $key => $value) {
                $totalTokens += $value['usage']['completion_tokens'];
            }
            $userToken->used_tokens += $totalTokens;
            $userToken->lastTokens -= $totalTokens;
            $userToken->save();
            $name = $request->type;
            return view('frontend.variation', compact('results', 'name'));
        } catch (Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
    public function getSocialMediaPrompt($data)
    {
         //dd($data->lang);
        $request = "Hello, can you write a social media ad post for this content here?

        - Business/Brand Name [$data->brand]
        - Short description of product or service [$data->desc_brand]
        - Provide bullet points of what makes your product/service better than others [$data->better_brand]
        - Variations [1]
        - Language Output [$data->lang]
       

        but can you write the content out in this form -

        Intro (Instead of hook call this Intro):

        Hook #1 (Remove pain point):
        Identify a common pain point or concern that the audience may have related to the topic.

        Hook #2 (Remove question):
        Pose a thought-provoking question that engages the audience and piques their curiosity.

        Hook #3 (Remove desire):
        Create a strong feeling of Desire in your customers for they to want what you have, and to be willing to purchase from you.

        Hook #4 (Remove mirror user's objective):
        Statement that mirrors the primary goal or problem of the target audience.

        Hook #5 (Remove story):
        Crafted brief narrative or scenario that resonates with the target audience.

        Value Prop:

        Clearly state the value proposition or the main benefit of the product or service.
        Highlight any unique features or advantages that set it apart.

        Stats:

        Include Numbers or Statistics (if applicable):
        Crafted statement using the provided statistic or number.

        Benefits:

        List the specific benefits or advantages that the audience can expect from using the product or service.
        Focus on the positive outcomes or improvements it can bring to their lives.

        Emotional Transformation:

        Connect with the audience on an emotional level.
        Describe the emotional impact or transformation they can experience by using the product or service.

        CTA (Call to Action):

        Encourage the audience to take a specific action.
        Provide a clear and compelling call to action that motivates them to act.
        Mention any incentives or special offers to create a sense of urgency.";
        return $request;
    }
    public function getEmailPrompt($data)
    {
        if ($data->date_type == "Limited") {
            $type = 'Limited';
        } else {
            $type = $data->end_date;
        }
        $request = "Based on the information below in brackets can you create an email that features the following
        -Subject line
        -Email copy

        Needed Items From User -
        -Business/Brand Name [$data->brand]
        -Short description of product or service [$data->desc_brand]
        -Provide bullet points of what makes your product/service better than others [$data->better_brand]
        -Promotion - Is this a limited time or offer ends on date? [$type]
        -Emails Needed [1]
        -Language Output [$data->lang]";
        return $request;
    }
    public function  edit()
    {
        if (Auth::user()->role == "Admin") {
            $data = ChatGpt::where('id', 1)->first();
            return view('admin.token.edit', compact('data'));
        } else {
            return redirect()->back()->with('error', 'You are not authorize to make this changes. Thank you');
        }
    }
    public function postEdit(Request $request)
    {
        if (Auth::user()->role == "Admin") {
            $User = ChatGpt::where('id', 1)->first();
            try {
                DB::beginTransaction();
                if ($request->default_tokens != $User->default_tokens) {
                    $users = User::get();
                    foreach ($users as $user) {
                        $user->update(['lastTokens' => $request->default_tokens]);
                    }
                }
                if ($User) {
                    $User->update($request->all());
                }
                DB::commit();
                return redirect()->back()->with('success', 'Record updated successfully!');
            } catch (Exception $e) {
                DB::rollback();
                DB::commit();
                return redirect()->back()->with('error', $e->getMessage());
            }
        } else {
            return redirect()->back()->with('error', 'You are not authorize to make this changes. Thank you');
        }
    }
}
