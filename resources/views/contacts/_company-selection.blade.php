
<select class="custom-select search-select" name="company_id" onchange="this.form.submit()">
    <option value="" selected>All Companies</option>
    @foreach($companies as $id => $name) 
        <option value="{{ $id }}" @if ($id == request()->query("company_id")) selected @endif> {{ $name }} </option>
    @endforeach
</select>


{{-- // selected items of company 
 <select id="filter_company_id" name="company_id" class="custom-select">
     @foreach ($companies as $id => $name)
         <option {{ $id == request()->query('company_id')  ? 'selected' : '' }} value="{{ $id }}">{{ $name }}</option>                
     @endforeach
 </select>

    // on change event for selected company 
 document
 .getElementById("filter_company_id")
 .addEventListener("change", function () {
     let companyId = this.value || this.options[this.selectedIndex].value;
     window.location.href =
         window.location.href.split("?")[0] + "?company_id=" + companyId;
 }); --}}
