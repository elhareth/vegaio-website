<?php

namespace App\Http\Controllers\Web;

use Exception;

use Illuminate\Database\QueryException;

use App\Support\Facades\SiteOptions as SiteOptionsFacade;

use App\Models\Article;
use App\Models\Service;
use App\Models\Category;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

use App\Http\Controllers\Controller;
use App\Models\ContactMessage;

class SiteController extends Controller
{
    /**
     *
     *
     */
    public function __construct()
    {
        $this->middleware('auth')->only([
            'home',
        ]);
    }

    /**
     * Show index page
     *
     * @param  Request $request
     * @return Renderable
     */
    public function index(Request $request)
    {
        $data = [];

        $Sections = SiteOptionsFacade::queryBy('group', 'index_sections');

        $data['HeroSection'] = $Sections->firstWhere('name', 'index_hero_section')->value->toArray();
        $data['AboutSection'] = $Sections->firstWhere('name', 'index_about_section')->value->toArray();
        $data['ContactSection'] = $Sections->firstWhere('name', 'index_contact_section')->value->toArray();
        $data['ServicesSection'] = $Sections->firstWhere('name', 'index_services_section')->value->toArray();

        return view('site.index', $data);
    }

    /**
     * Show home page
     *
     * @param  Request $request
     * @return Renderable
     */
    public function home(Request $request)
    {
        return $this->index($request);
        // return view('site.home');
    }

    /**
     * Show about page
     *
     * @param  Request $request
     * @return Renderable
     */
    public function about(Request $request)
    {
        return view('site.about');
    }

    /**
     * Contact
     *
     * @param  Request $request
     * @return Response|Renderable
     */
    public function contact(Request $request)
    {
        if ($request->isMethod('POST') && $request->ajax()) {
            $data = [
                'name' => null,
                'email' => null,
                'subject' => null,
                'message' => null,
            ];

            $response = [
                'code' => Response::HTTP_NO_CONTENT,
                'success' => false,
                'message' => null,
            ];

            try {
                if ($request->user()) {
                    $data = array_merge($request->validate([
                        'subject' => 'required|string|min:2|max:1000',
                        'message' => 'required|string|min:10',
                    ]));

                    $data['name'] = $request->user()->getDisplayName();
                    $data['email'] = $request->user()->email;
                } else {
                    $data = array_merge($request->validate([
                        'name' => 'required|string|min:2|max:15',
                        'email' => 'required|email',
                        'subject' => 'required|string|max:1000',
                        'message' => 'required|string|min:10',
                    ]));
                }

                $data['name'] = $request->has('name') ? $request->input('name') : $data['name'];
                $data['email'] = $request->has('email') ? $request->input('email') : $data['email'];
                $data['subject'] = $request->input('subject');
                $data['message'] = $request->input('message');

                $ContactMessage = ContactMessage::create($data);

                if ($ContactMessage) {
                    $response['code'] = Response::HTTP_CREATED;
                    $response['success'] = true;
                    // $response['message'] = 'Your message has been sent. Thank you!';
                    $response['message'] = __('models/contact-message.alerts.message-sent.message');
                } else {
                    $response['code'] = Response::HTTP_ACCEPTED;
                    // $response['message'] = 'Error! Please reload the page and try again.';
                    $response['message'] = __('models/contact-message.alerts.send-failed.message');
                }
            } catch(QueryException $qe) {
                $response['code'] = Response::HTTP_NOT_FOUND;
                // $response['message'] = 'Error! We\'re having trouble sending your message now, Please try again later!';
                $response['message'] = __('models/contact-message.alerts.send-error.message');
            } catch (Exception $e) {
                $response['code'] = Response::HTTP_PARTIAL_CONTENT;
                $response['message'] = $e->getMessage();
                // $response['message'] = __('models/contact-message.alerts.send-error.message');
            }

            return response()->json($response);
        } else {
            return view('site.contact');
        }
    }

    /**
     * Show terms page
     *
     * @param  Request $request
     * @return Response|Renderable
     */
    public function tos(Request $request)
    {
        return view('site.tos');
    }

    /**
     * Show policy page
     *
     * @param  Request $request
     * @return Response|Renderable
     */
    public function policy(Request $request)
    {
        return view('site.policy');
    }

    /**
     * Show services page
     *
     * @param  Request $request
     * @return Response|Renderable
     */
    public function services(Request $request)
    {
        return view('site.page.services');
    }

    /**
     * Show service
     *
     * @param  Request $request
     * @param  Service $service
     * @return Response|Renderable
     */
    public function service(Request $request, Service $service)
    {
        $data = [];
        $data['service'] = $service;
        return view('site.page.service', $data);
    }
}
