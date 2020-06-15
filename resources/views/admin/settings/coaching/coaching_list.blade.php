@if(count($coachingtypes) > 0)
                        @foreach ($coachingtypes as $coachingtype)
                            <tr>
                                <td>{{ $loop->index+1 }}</td>
                                <td>{{ $coachingtype->class_name }}</td>
                                <td>{{ $coachingtype->coaching_type}}</td>
                                <td>
                                    @if($coachingtype->status == 1)
                                    <span class="badge bg-green">Active</span>
                                    @else
                                    <span class="badge bg-red">Inactive</span>
                                    @endif
                                </td>
                                <td>
                                    @if($coachingtype->status == 1)
                                    <button onclick='unpublish("{{$coachingtype->id}}")' class="btn btn-sm btn-success" id="unpublished"><span class="fa fa-arrow-alt-circle-up"></span></button>
                                    @else
                                    <button onclick='publish("{{$coachingtype->id}}")' class="btn btn-sm btn-warning" id="published"><span class="fa fa-arrow-alt-circle-up"></span></button>
                                    @endif
                                    <button onclick='delItem("{{$coachingtype->id}}", "{{$coachingtype->class_name_id}}")' class="btn btn-sm btn-danger" id="detItem"><span class="fa fa-trash"></span></button>
                                </td>
                            </tr>
                        @endforeach
                      @else
                      <tr>
                        <td colspan="5">
                          <p>Data Not Found</p>
                        </td>
                      </tr>
                      @endif
<script type="text/javascript">
    
</script>