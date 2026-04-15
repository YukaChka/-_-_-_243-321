@extends('layouts.app')

@section('content')
    <h2>Контакты</h2>
    <div style="margin-top: 16px;">
        @foreach($contacts as $contact)
            <div style="background: #fff; border: 1px solid #ddd; border-radius: 6px; padding: 16px; margin-bottom: 12px;">
                <h3 style="font-size: 18px; margin-bottom: 6px;">{{ $contact['name'] }}</h3>
                <p style="font-size: 14px; color: #555;">
                    <strong>Телефон:</strong> {{ $contact['phone'] }}
                </p>
                <p style="font-size: 14px; color: #555;">
                    <strong>Email:</strong> {{ $contact['email'] }}
                </p>
            </div>
        @endforeach
    </div>
@endsection
