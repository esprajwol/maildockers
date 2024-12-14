@if (in_array($isAttachmentSelected, ["1", "2"]))
    <section class="pdf-message-collection" id="documents">
        <h4>{{ localize('pdf_list_between_two_parties') }}:</h4>
        <br />
        @foreach ($documentList as $document)
            <div>
                <span>{{ $document['date'] }} | {{ $document['time'] }} | {{ $document['sender_name'] }} |
                    {{ $document['file_name'] }}</span>
                <br /> <br />
            </div>
        @endforeach
    </section>
@endif
