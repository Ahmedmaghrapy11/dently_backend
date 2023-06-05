<tr>
<td class="header">
<a href="{{ $url }}" style="display: inline-block;">
@if (trim($slot) === 'Laravel')
{{-- <img src="https://drive.google.com/file/d/1duBI_copNcGxMZfSeOcbQxWBW7BIGqvd/view?usp=drive_link" class="logo" alt="Dently Logo"> --}}
@else
{{ $slot }}
@endif
</a>
</td>
</tr>
