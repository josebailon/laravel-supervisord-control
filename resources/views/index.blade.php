 @if (Config::get('jbosupervisord.extend_view'))
 @include('lsc::wrapper')
 @else
 @include('lsc::content')
 @endif
