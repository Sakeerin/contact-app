<tr>
  <th scope="row"> {{ $contacts->firstItem()+ $index }} </th>
  <td> {{ $contact->first_name }} </td>
  <td> {{ $contact->last_name }} </td>
  <td>{{ $contact->email }}</td>
  <td>{{ $contact->company->name }}</td>
  {{-- <td>{{ optional($contact->company)->name }}</td> --}}
  <td width="150">
    @if ($showTrashButtons)
        @include('shared.buttons.restore',[
            'action' => route('contacts.restore',$contact->id)
        ])
       @include('shared.buttons.force-delete',[
            'action' => route('contacts.force-delete',$contact->id)
       ])
    @else
        <a href="{{ route('contacts.show', $contact->id) }}" class="btn btn-sm btn-circle btn-outline-info" title="Show"><i class="fa fa-eye"></i></a>
        <a href="{{ route('contacts.edit', $contact->id) }}" class="btn btn-sm btn-circle btn-outline-secondary" title="Edit"><i class="fa fa-edit"></i></a>
        @include('shared.buttons.destroy',[
          'action' => route('contacts.destroy', $contact->id)
        ])
    @endif
    
  </td>
</tr>

{{-- fn delete contact another way --}}
{{-- <a href="{{ route('contacts.destroy', $contact->id) }}" class="btn btn-sm btn-circle btn-outline-danger btn-delete" title="Delete"><i class="fa fa-times"></i></a>
<script>
  document.querySelectorAll(".btn-delete").forEach((button) => {
    button.addEventListener("click", function (event) {
        event.preventDefault();
        if (confirm("Are you sure?")) {
            let action = this.getAttribute("href");
            let form = document.getElementById("form-delete");
            form.setAttribute("action", action);
            form.submit();
        }
    });
});
</script> --}}