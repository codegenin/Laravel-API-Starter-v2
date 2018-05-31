@extends('layouts.mail.default')

@section('header')
    <tr>
        <td class="header">
            <a href="{{ url('/verify/' . $token) }}">
                YoYoGi Email Account Verification
            </a>
        </td>
    </tr>
@endsection
@section('content')

    <p>Your request will not be processed unless you confirm the email address using the button below.</p>

    <br>

    <table class="action" align="center" width="100%" cellpadding="0" cellspacing="0">
        <tr>
            <td align="center">
                <table width="100%" border="0" cellpadding="0" cellspacing="0">
                    <tr>
                        <td align="center">
                            <table border="0" cellpadding="0" cellspacing="0">
                                <tr>
                                    <td>
                                        <a href="{{ url('/verify/' . $token) }}" class="button button-{{ $color ?? 'blue' }}" target="_blank">
                                            Verify Account
                                        </a>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>

    Thanks,<br>
    {{ config('app.name') }}
@endsection