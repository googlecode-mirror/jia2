$(function() {
        $("input[name='submit']").click(function() {
                email = $("input[name='email']").val()
                pass = $("input[name='pass']").val()
                $.post(SITE_URL+"index/do_login", {
                    ajax:1,
                    email:email,
                    pass:pass
                }, function(data) {
                    if(data.verify == 1) {
						window.location.href = SITE_URL;
                    } else {
                        $("#email_prompt").text(data.email);
                        $("#pass_prompt").text(data.pass);
                        return false;
                    }
                   }, 'json'
                );
                return false;
        })
});