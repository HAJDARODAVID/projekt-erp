<div class="modal @if ($size) modal-{{ $size }} @endif" style="display: @if($show) block @endif; {{ $blur }}; @if($z) z-index: {{ $z }}; @endIf">
    <div class="modal-dialog @if ($position) {{ $position }} @endif" role="document" 
        style="@if($customWidth) max-width: {{ $customWidth }}px !important @endif">
        <div class="modal-content">
            @if ($alert)
                <div class="alert @if ($aType) alert-{{ $aType }} @endif mb-0" role="alert">
                    <h4 class="alert-heading">{{ $mainTitle }}</h4>
                    <p>{{ $slot }}</p>
                    <hr>
                    {{ $footerItems }}
                </div>
            @else
                @if ($header)
                    <div class="modal-header d-flex justify-content-between align-items-center">
                            <div>
                                <h5 class="modal-title">
                                    {{ $mainTitle }} 
                                </h5>
                                @if ($secTitle)
                                    <p class="mb-0">{{ $secTitle }}</p>  
                                @endif
                            </div>
                            <div>
                                {{ $headerBtn }}
                            </div>
                    </div>
                @endif
                
                @if ($body)
                    <div class="modal-body">
                        {{ $slot }}
                    </div>
                @endif

                @if ($footer)
                    <div class="modal-footer">
                        {{ $footerItems }}
                    </div>
                @endif
            @endif            
        </div>
    </div>
</div>