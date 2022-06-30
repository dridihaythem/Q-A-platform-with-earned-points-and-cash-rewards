<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Services\RegisterService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Laravel\Socialite\Facades\Socialite;

class ProviderAuthController extends Controller
{
    private $providers = ['facebook', 'google', 'twitter'];

    public function __construct(private RegisterService $registerService)
    {
    }
    private function checkValidProvider($provider)
    {
        abort_if(!in_array($provider, $this->providers), 404);
    }

    public function redirect($provider)
    {
        $this->checkValidProvider($provider);

        return Socialite::driver($provider)->redirect();
    }

    public function callback($provider)
    {
        $this->checkValidProvider($provider);

        try {
            $data = Socialite::driver($provider)->user();

            // check if user exist

            $user = User::where([
                'provider' => $provider,
                'provider_id' => $data->id
            ])->first();

            if (!$user) {
                $user = User::create([
                    'provider' => $provider,
                    'provider_id' => $data->id,
                    'name' => $data->name,
                    'email' => $data->email,
                    'avatar' => $this->getAvatar($data->getAvatar())
                ]);

                $this->registerService->updateRef($user);
            }

            Auth::login($user);

            return redirect()->route('questions.index');
        } catch (Exception $e) {
            abort(404);
        }
    }

    private function getAvatar($url)
    {
        $contents = file_get_contents($url);

        //check extension

        if (!array_key_exists('extension', pathinfo($url)) || !in_array(pathinfo($url)['extension'], ['png', 'jpg'])) {
            $extension = 'png';
        } else {
            $extension = pathinfo($url)['extension'];
        }

        // generate a file name

        $filename = Str()->uuid() . "." . $extension;

        Storage::disk('images')->put($filename, $contents);

        return $filename;
    }
}
