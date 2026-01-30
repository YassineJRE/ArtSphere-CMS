<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Emails\Web\NotifyAdminForContactUs;
use Mail;
use Validator;

class ContactUsController extends BaseController
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(\App\Http\Middleware\VerifyCsrfToken::class);
    }

    /**
     * Send an e-mail contact us to administrator.
     *
     * @param  Request  $request
     * @return Response
     */
    public function sendEmail(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required'
        ]);

        if (!$validator->fails())
        {
            if ($request->isMethod('post'))
            {
                Mail::send(new NotifyAdminForContactUs($request));
                $request->session()->flash('success', __('contact-us.message.success.contact-us-success'));
                return response()->json([
                    'status' => 'success',
                    'view' => view('admin.components.notifications')->render(),
                ]);
            }
        }

        $request->session()->flash('error', __('contact-us.message.success.contact-us-error'));
        return response()->json([
            'status' => 'error',
            'view' => view('admin.components.notifications')->render(),
        ]);
    }
}
