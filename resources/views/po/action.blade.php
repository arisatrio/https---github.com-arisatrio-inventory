@if(!$is_selesai)
<a href="{{ route('po.order.show', Crypt::encrypt($id)) }}" class="btn btn-sm btn-primary mb-2">
    <i class="fa fa-list"></i> Detail
</a>
<br>
<button class="btn btn-sm btn-outline-danger" onclick="destroy({{ $id }})">
    <i class="fa fa-trash"></i>
</button>
<a href="{{ route('po.order-produk.show', $id) }}" class="btn btn-sm btn-outline-info" title="Edit">
    <i class="fa fa-edit"></i>
</a>
@else
<a href="{{ route('po.order.print', $id) }}" rel="noopener" target="_blank" class="btn btn-default" data-toggle="tooltip" data-placement="top" title="Print PO">
    <i class="fas fa-print text-danger"></i>
</a>
<a href="{{ route('po.order.print-delivery', $id) }}" rel="noopener" target="_blank" class="btn btn-default" data-toggle="tooltip" data-placement="top" title="Print Surat Jalan">
    <i class="fas fa-print text-success"></i>
</a>
@endif