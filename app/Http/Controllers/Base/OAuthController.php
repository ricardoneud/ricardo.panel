<?php

namespace Pterodactyl\Http\Controllers\Base;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Laravel\Socialite\Facades\Socialite;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;
use Pterodactyl\Http\Controllers\Controller;
use Pterodactyl\Services\Users\UserUpdateService;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Throwable;

class OAuthController extends Controller
{
    private UserUpdateService $updateService;

    /**
     * The route to redirect a user once unlinked with the OAuth provider or if the provider doesn't exist.
     *
     * @var string
     */
    protected string $redirectRoute = 'account';

    /**
     * LoginController constructor.
     *
     * @param UserUpdateService $updateService
     */
    public function __construct(UserUpdateService $updateService)
    {
        $this->updateService = $updateService;
    }

    /**
     * Redirect to the provider's website
     *
     * @param Request $request
     * @return RedirectResponse
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    protected function link(Request $request): RedirectResponse
    {
        if (!app('config')->get('pterodactyl.auth.oauth.enabled')) {
            throw new NotFoundHttpException();
        }

        $drivers = json_decode(app('config')->get('pterodactyl.auth.oauth.drivers'), true);
        $driver = $request->get('driver');

        if ($driver == null || !array_has($drivers, $driver) || !$drivers[$driver]['enabled']) {
            return redirect($this->redirectRoute);
        }

        // Dirty hack
        // Can't use SocialiteProviders\Manager\Config since all providers are hardcoded for services.php
        config(['services.' . $driver => array_merge(
            array_only($drivers[$driver], ['client_id', 'client_secret']),
            ['redirect' => route('oauth.callback')]
        )]);

        $request->session()->put('oauth_linking', $driver);

        return Socialite::with($driver)->redirect();
    }

    /**
     * Link OAuth id to user
     *
     * @param Request $request
     * @return RedirectResponse
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     * @throws Throwable
     */
    protected function unlink(Request $request): RedirectResponse
    {
        $driver = $request->get('driver');

        if (empty($driver)) {
            return redirect($this->redirectRoute);
        }

        $drivers = json_decode(app('config')->get('pterodactyl.auth.oauth.drivers'), true);

        if (!array_has($drivers, $driver) || !$drivers[$driver]['enabled']) {
            return redirect($this->redirectRoute);
        }

        $oauth = json_decode($request->user()->oauth, true);

        unset($oauth[$driver]);

        $this->updateService->handle($request->user(), ['oauth' => json_encode($oauth)]);

        return redirect($this->redirectRoute);
    }
}
