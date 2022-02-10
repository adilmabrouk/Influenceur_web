<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Adresse;
use App\Models\Influenceur;
use App\InstagramApi\Infos;
use App\Models\Instagram;
use App\Models\Instagram_Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class AuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['register', 'login']]);
    }

    public function register(Request $request)
    {
        $influenceurRules = [
            'nom' => 'required|string',
            'prenom' => 'required|string',
            'email' => 'required|email|unique:influenceurs',
            'password' => 'required|min:6|confirmed',
            'date_naissance' => 'required',
            'genre'  => 'required',
            'situation_familiale'  => 'required',
            'niveau_etude'  => 'required',
            'profession'  => 'required',
            'telephone'  => 'required|unique:influenceurs',
            'instagram' => 'required|unique:influenceurs',
        ];

        $this->validate($request, $influenceurRules);

        $influenceurData = $request->all();

        $influenceurData['password'] = bcrypt($request->password);

        $influenceur = Influenceur::create($influenceurData);

        $adresseRules = [
            'ville' => 'required|string',
            'quartier' => 'required|string',
        ];

        $adresseData = $this->validate($request, $adresseRules);
        $adresseData['influenceur_id'] = $influenceur->id;

        $adresse = Adresse::create($adresseData);

        $adresse->influenceur()->associate($influenceur);


        $influenceur->langues()->sync($request->langues);

       // $this->getInstagramInfos($influenceur->instagram, $influenceur->id);

       /* return response()->json([
            'message' => 'influenceur successfuly registred',
            'user' => $influenceur
        ], 201); */

        return $this->login($request);
    }


    public function login(Request $request)
    {
        $rules = [
            'email' => 'required|email',
            'password' => 'required|min:6'
        ];

        $this->validate($request, $rules);

        $credentials = request(['email', 'password']);

        if (!$token = auth()->attempt($credentials)) {
            return response()->json(['error' => 'The email or Password is Incorrect'], 401);
        }

        return $this->respondWithToken($token);
    }

    public function logout()
    {
        auth()->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

    public function profile()
    {
        return response()->json(auth()->user());
    }



    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60,
            'user' => auth()->user()
        ]);
    }


    private function getInstagramInfos($username, $influenceurId)
    {
        $profile = Http::withHeaders([
            'x-rapidapi-host' => 'instagram-profile1.p.rapidapi.com',
            'x-rapidapi-key' => 'f9f16ac42bmsh1e55eb313095fe5p102e64jsn787ca8b676f5'
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
