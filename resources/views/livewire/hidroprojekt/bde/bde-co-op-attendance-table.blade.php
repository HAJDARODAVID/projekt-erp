<div>
    <div class="">
        @foreach ($attendance as $groupName => $group)
            <div class="row">
                <div class="col">
                    <b>{{ $groupName }}</b>
                </div>
                <div class="col">
                    <div class="float-end">
                        <button class="btn btn-danger btn-sm" style="height: 25px" wire:click="removeGroupFromAttendance('{{ $groupName }}')">
                            <i class="bi bi-trash"></i>
                        </button>
                        <button class="btn btn-dark btn-sm" style="height: 25px" onclick="hideShowTableCoOp('{{ $groupName }}')">__</button>
                    </div>
                    
                </div>
            </div>
            <hr class="my-1">
            
            <table class="table" id="{{ $groupName }}">
                <thead>
                    <tr>
                        <td><b>Ime</b></td>
                        <td><b>Sati</b></td>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($group as $worker)
                        <tr>
                            <td>{{ $worker['firstName'] }}</td>
                            <td>
                                <input wire:model.blur='hours.{{ $worker['id'] }}' class="form-control " type="number" style="display: inline;width: 50px" >
                                <button wire:click.prevent='removeCoOpWorkerFromAttendance({{ $worker['id'] }})' class="btn btn-danger btn-sm" style="display: inline"><i class="bi bi-trash"></i></button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <hr>
        @endforeach
    </div>

    <script>
        function hideShowTableCoOp(idTable){
            let element = document.getElementById(idTable); 
            if(element.style.display == ""){
            element.style.display = "none";
            }else{
            element.removeAttribute("style");
            }    
        }
    </script>
</div>
