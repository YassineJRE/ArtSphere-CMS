@isset($subject->title)
@foreach (Config::get('languages') as $lang => $language)
<tr>
    <td>title [{{ $language }}]</td>
    <td>{{ $subject->title->{$lang} }}</td>
</tr>
@endforeach
@endisset

@isset($subject->description)
@foreach (Config::get('languages') as $lang => $language)
<tr>
    <td>description [{{ $language }}]</td>
    <td>{{ $subject->description->{$lang} }}</td>
</tr>
@endforeach
@endisset

@isset($subject->icons)
@foreach (\App\Enums\Platform::list() as $platform)
<tr>
    <td>icons [{{ $platform }}]</td>
    <td>{{ $subject->icons->{$platform} }}</td>
</tr>
@endforeach
@endisset
