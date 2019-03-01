@php
    $total = $entities->total();
@endphp
<span>
    <label class="{{!$total ? 'disabled ' : 'mouse-pointer '}}  checkbox-inline"
           for="check_all_mass_destroy">
        <input {{!$total ? 'disabled ' : ''}} type="checkbox" class="check mouse-pointer"
               id="check_all_mass_destroy">
        {{trans('actions.selectAll')}}
    </label>
</span>