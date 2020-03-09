{{-- notice_pdf --}}
@if ($dynamicContents && $files)
    <?php
        $file = $files->first(function ($file) use ($dynamicContents){
            return $file->id == $dynamicContents->notice_pdf;
        });
        $fileName = $file ? $file->name : ''
    ?>

    <div class="js-scroll animation-slide-in-bottom">
        <a class="download" href="{{ route('assets.files', ['name' => $fileName]) }}">
            <div class="download__icon">
                {{-- HACK: pdfのアイコンに差し替える --}}
                <img src="http://placehold.jp/27x32.png" alt="PDF">
            </div>
            <div class="download__detail">
                <div class="download__title">
                    @if (property_exists($dynamic, 'notice_pdf__pdf__title' ))
                        <span>{{ $dynamicContents->notice_pdf__pdf__title }}</span>
                    @endif
                </div>
                <div class="download__description">
                    @if (property_exists($dynamic, 'notice_pdf__pdf__description' ))
                        {{ $dynamicContents->notice_pdf__pdf__description }}
                    @endif
                </div>
            </div>
        </a>
    </div>
@endif
