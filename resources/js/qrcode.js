
    const CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
    var $generateLinkModal = $('#generateLinkModal');
    var $qrcodeModal = $('#qrcodeModal');
    var sharedLinkResponse;

    let applyParams = function(sort) {
        let url = new URL(location.href);
        let searchParams = new URLSearchParams(url.search);
        searchParams.set('sort', sort);
        url.search = searchParams.toString();

        location.href = url
    }

    let sortBy = function(newSort) {
        applyParams(newSort);
    }

    let generateSharedLink = function (file){
    let route = "{{ route('create_file_shared_link', '__fileId__') }}".replace('__fileId__', file.id);
    let expire_at = $('#expire_at').val();
            $.ajax({
            method: 'POST',
            url: route,
            data: {_token: CSRF_TOKEN, 'expire_at':expire_at},
            dataType: "json",
            success: function(response) {
            $('#generatedLink').val(response.data)
            generateQRCode(response.data)
            $generateLinkModal.modal('hide')
            $qrcodeModal.modal('show');
            sharedLinkResponse = response;
        },
            error:function (error){
            sharedLinkResponse = error;
        }
        })
    }

    let saveQRCode = function (){
            if(sharedLinkResponse){
            toastr.success("File Shared link created successfully");
        }else {
            toastr.error("Fail! Unable to generate Shared link for this file");
        }
    }

    let copyToClipboard = function() {
        navigator.clipboard.writeText(($('#link').val()))
        $('#copy').html('Copied')
    }

    let generateQRCode = function (url){
        var qrcode = new QRCode(document.getElementById('qr_code'),{
            width:250,
            height:250
        });
        qrcode.makeCode(url);
    }
