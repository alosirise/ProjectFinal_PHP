function test() {
    $.ajax({
        dataType:'json',
        type: 'POST',
        url: 'test.php',
        data: {
             'bew' :'testdata1'
        },
        success: function () {
            console.log("success");
        }
    });
}