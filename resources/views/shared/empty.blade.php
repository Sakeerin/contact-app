<tr>
    <td colspan="{{ $numCol }}">
        <div class="alert alet-danger">
            @isset($message)
                {{ $message }}
            @else
                No record found
            @endisset
        </div>
    </td>
</tr>