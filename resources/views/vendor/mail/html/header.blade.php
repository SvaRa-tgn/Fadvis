@props(['url'])
<tr>
<td class="header">
<a href="{{ $url }}" style="display: inline-block;">
@if (trim($slot) === 'Fadvis')
<img src="http://fadvis.ru/files/fadvis-logo-main-prosthesis.svg" class="logo" alt="fadvis Logo">
@else
{{ $slot }}
@endif
</a>
</td>
</tr>
