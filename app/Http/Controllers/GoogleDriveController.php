<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Auth;
use Laravel\Socialite\Facades\Socialite;

class GoogleDriveController extends Controller
{
    // public $gClient;

    function __construct()
    {

        $this->gClient = new \Google_Client();

        $this->gClient->setApplicationName('Fashion Forge'); // ADD YOUR AUTH2 APPLICATION NAME (WHEN YOUR GENERATE SECRATE KEY)
        $this->gClient->setClientId('468787788273-5pc52mfi5d1o3ob8t86sdsge1pikeh2q.apps.googleusercontent.com');
        $this->gClient->setClientSecret('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');
        // 308799378314-e0sn7hivc4ikaphguhq7npgnaie83f6i.apps.googleusercontent.com
        // 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
        $this->gClient->setRedirectUri(route('google.login'));
        $this->gClient->setDeveloperKey('AIzaSyCY5z4BjwrnS_t-QK4Rc5nXNL0974c-D6A');
        $this->gClient->setScopes(array(
            'https://www.googleapis.com/auth/drive.file',
            'https://www.googleapis.com/auth/drive'
        ));

        $this->gClient->setAccessType("offline");

        $this->gClient->setApprovalPrompt("force");
    }

    // public function googleLogin(Request $request)
    // {

    //     $google_oauthV2 = new \Google_Service_Oauth2($this->gClient);

    //     if ($request->get('code')) {

    //         $this->gClient->authenticate($request->get('code'));

    //         $request->session()->put('token', $this->gClient->getAccessToken());
    //     }

    //     if ($request->session()->get('token')) {

    //         $this->gClient->setAccessToken($request->session()->get('token'));
    //     }

    //     if ($this->gClient->getAccessToken()) {

    //         //FOR LOGGED IN USER, GET DETAILS FROM GOOGLE USING ACCES
    //         $user = User::find(1);

    //         $user->access_token = json_encode($request->session()->get('token'));

    //         $user->save();

    //         dd("Successfully authenticated");
    //     } else {

    //         // FOR GUEST USER, GET GOOGLE LOGIN URL
    //         $authUrl = $this->gClient->createAuthUrl();

    //         return redirect()->to($authUrl);
    //     }
    // }

    // public function googleDriveFilePpload()
    // {
    //     $service = new \Google_Service_Drive($this->gClient);

    //     $user = User::find(1);

    //     $this->gClient->setAccessToken(json_decode($user->access_token, true));

    //     if ($this->gClient->isAccessTokenExpired()) {

    //         // SAVE REFRESH TOKEN TO SOME VARIABLE
    //         $refreshTokenSaved = $this->gClient->getRefreshToken();

    //         // UPDATE ACCESS TOKEN
    //         $this->gClient->fetchAccessTokenWithRefreshToken($refreshTokenSaved);

    //         // PASS ACCESS TOKEN TO SOME VARIABLE
    //         $updatedAccessToken = $this->gClient->getAccessToken();

    //         // APPEND REFRESH TOKEN
    //         $updatedAccessToken['refresh_token'] = $refreshTokenSaved;

    //         // SET THE NEW ACCES TOKEN
    //         $this->gClient->setAccessToken($updatedAccessToken);

    //         $user->access_token = $updatedAccessToken;

    //         $user->save();
    //     }

    //     $fileMetadata = new \Google_Service_Drive_DriveFile(array(
    //         'name' => 'Webappfix',             // ADD YOUR GOOGLE DRIVE FOLDER NAME
    //         'mimeType' => 'application/vnd.google-apps.folder'
    //     ));

    //     $folder = $service->files->create($fileMetadata, array('fields' => 'id'));

    //     printf("Folder ID: %s\n", $folder->id);

    //     $file = new \Google_Service_Drive_DriveFile(array('name' => 'cdrfile.jpg', 'parents' => array($folder->id)));

    //     $result = $service->files->create($file, array(

    //         'data' => file_get_contents(public_path('Screenshot_1.png')), // ADD YOUR FILE PATH WHICH YOU WANT TO UPLOAD ON GOOGLE DRIVE
    //         'mimeType' => 'application/octet-stream',
    //         'uploadType' => 'media'
    //     ));

    //     // GET URL OF UPLOADED FILE

    //     $url = 'https://drive.google.com/open?id=' . $result->id;

    //     dd($result);
    // }


    // public function provider(){
    //     return Socialite::driver('google')->redirect();
    // }

    // public function callbackHandle(){
    //     return $user = Socialite::driver('google')->user();
    //     dd($user);
    // }


}
