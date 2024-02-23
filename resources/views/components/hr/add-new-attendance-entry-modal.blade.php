<div>
    <a class="btn btn-success btn-sm" href="#" onclick="showModal('addNewAttendanceEntry')">NOVI ZAPIS</a>

    <!-- Modal -->
    <div class="modal" id="addNewAttendanceEntry" style="display:  @if (Session::has('errors')) block @else none @endif">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Novi zapis prisutnosti radnika</h5>
            </div>
            <div class="modal-body">
                <div class="row">
                    {{-- <div class="col">
                        <div class="form-group mb-2">
                            <label for="date">Datum zapisa:</label>
                            <input type="date" class="form-control @error('start_date')is-invalid @enderror" id="date" name="date">
                        </div>
                    </div> --}}
                    <div class="col">
                        <label>Vrsta zapisa:</label><br>
                        <button class="btn btn-success" onclick="showModule('wdrContainer')"><i class="bi bi-cone-striped"></i></button>
                        <button class="btn btn-warning" onclick="showModule('sickLeaveContainer')">BO</button>
                        <button class="btn btn-primary" onclick="showModule('paidLeaveContainer')">GO</button>
                    </div>
                </div>
                <hr>
                {{-- SICK LEAVE CONTAINER --}}
                <div id="sickLeaveContainer" style="display:none" class="absenceModule">
                    @livewire('hidroProjekt.hr.add-sick-leave-to-attendance',[
                        'worker' => $worker['id'],
                    ])    
                </div>
                {{-- PAID LEAVE CONTAINER --}}
                <div id="paidLeaveContainer" style="display:none" class="absenceModule">
                    @livewire('hidroProjekt.hr.add-paid-leave-to-attendance',[
                        'worker' => $worker['id'],
                    ])
                </div>

                {{-- WDR CONTAINER --}}
                <div id="wdrContainer" style="display:none" class="absenceModule">
                    <b>Prisustvo na gradilištu</b>
                    Riješenje nije implementirano
                    {{-- <div class="row">
                        <div class="col">
                            <div class="form-group mb-2">
                                <label for="date">Od:</label>
                                <input type="date" class="form-control @error('start_date')is-invalid @enderror" id="date" name="date">
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group mb-2">
                                <label for="date">Do:</label>
                                <input type="date" class="form-control @error('start_date')is-invalid @enderror" id="date" name="date">
                            </div>
                        </div>
                    </div> --}}
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" onclick="closeModal('addNewAttendanceEntry')">ZATVORI</button>
            </div>
            </div>
        </div>
    </div>
    <script>

        function showModal(modal) {
            document.getElementById(modal).style.display = 'block';
        }
        function closeModal(modal) {
            document.getElementById(modal).style.display = 'none';
        }
        function submitForm(form){
            event.preventDefault();
            document.getElementById(form).submit();
        }

        function showModule(moduleId) {
            let modules = document.getElementsByClassName('absenceModule');
            let i = 0;

            while (i < modules.length) {
                if (modules[i].id == moduleId) {
                    document.getElementById(modules[i].id).style.display = 'block';
                }else{
                    document.getElementById(modules[i].id).style.display = 'none';
                }
                i++;
            }
        }
    </script>
</div>