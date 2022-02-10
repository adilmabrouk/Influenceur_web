<?php

namespace App\InstagramApi;

use App\Models\Instagram;
use App\Models\Instagram_Post;
use Illuminate\Support\Facades\Http;

class Infos
{

    static function getInstagramInfos($username, $influenceurId)
    {
        $profile = Http::withHeaders([
            'x-rapidapi-host' => 'instagram-profile1.p.rapidapi.com',
            'x-rapidapi-key' => 'a18b4b0b14msh2923f21c574f5ccp16d379jsn0327fb72dec5'
        ])->get('https://instagram-profile1.p.rapidapi.com/getprofile/' . $username);


        $instagram = new Instagram();
        $instagram->username = $profile->json('username');
        $instagram->full_name = $profile->json('full_name');
        $instagram->followers = $profile->json('followers');
        $instagram->following = $profile->json('following');
        $instagram->category_name = $profile->json('category_name');
        $instagram->profile_pic_url = $profile->json('profile_pic_url');
        $instagram->influenceur()->associate($influenceurId);
        $instagram->save();

        $media =  $profile->json('lastMedia.media');
        $posts = new Instagram_Post();

        foreach ($media as $item) {
            $posts->like = $item['like'];
            $posts->comment_count = $item['comment_count'];
            $posts->caption = $item['caption'];
            $posts->views = null;
            $posts->link_to_post = $item['link_to_post'];
            $posts->thumbnail_src = $item['thumbnail_src'];
            $posts->timestamp = $item['timestamp'];
            $posts->instagram()->associate($instagram->id);
            $posts->save();
        }
    }
}
