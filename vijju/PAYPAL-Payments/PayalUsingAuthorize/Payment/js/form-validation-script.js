
var Script = function () {

    $.validator.setDefaults({
        submitHandler: function(form) { form.submit(); }
    });

    $().ready(function() {
        // validate the comment form when it is submitted
        $("#commentForm").validate();

        // validate signup form on keyup and submit
        $("#signupForm").validate({
               rules: {
                businessname: "required",
                description: "required",
                emailid: {
                    required: true
                },
               zip: {
                    required: true
                },
               username: {
                    required: true,
                    minlength: 2
                },
				charityName: {
                    required: true
                },
				DefaultCharity: {
                    required: true
                },
				DefaultRoundedAmt: {
                    required: true
                },
				DefaultUser: {
                    required: true
                },
				address: {
                    required: true
                },
				website: {
                    required: true,
                },
				eniNumber: {
                    required: true,
                    minlength: 2
                },
                newpassword: {
                    required: false,
                    minlength: 5
                },
                password: {
                    required: true,
                    minlength: 5
                },
                confirm_password: {
                    required: true,
                    minlength: 5,
                    equalTo: "#password"
                },
                email: {
                    required: true,
                    email: true
                },
                topic: {
                    required: "#newsletter:checked",
                    minlength: 2
                },
                agree: "required"
            },
            messages: {
                businessname: "Please enter Business Name",
                emailid: {
                    required: "Please Enter a Email Id"
                    
                },
               zip: {
                    required: "Please Enter Zip Code"
                    
                },
				charityName: "Please enter Charity Name",
				DefaultCharity: "Please Select Charity",
				DefaultRoundedAmt: "Please enter Rounded Amount",
				DefaultUser: "Please Select User",
				address: "Please enter Address",
				website: "Please enter Website",
				eniNumber: "Please enter ENI Number",
                description: "Please enter Description",
                username: {
                    required: "Please enter a username",
                    minlength: "Your username must consist of at least 2 characters"
                },
                newpassword: {
                    
                    minlength: "Your password must be at least 5 characters long"
                },
                password: {
                    required: "Please provide a password",
                    minlength: "Your password must be at least 5 characters long"
                },
                confirm_password: {
                    required: "Please provide a password",
                    minlength: "Your password must be at least 5 characters long",
                    equalTo: "Please enter the same password as above"
                },
                email: "Please enter a valid email address",
                agree: "Please accept our policy"
            }
        });

        // propose username by combining first- and lastname
        $("#username").focus(function() {
            var firstname = $("#firstname").val();
            var lastname = $("#lastname").val();
            if(firstname && lastname && !this.value) {
                this.value = firstname + "." + lastname;
            }
        });

        //code to hide topic selection, disable for demo
        var newsletter = $("#newsletter");
        // newsletter topics are optional, hide at first
        var inital = newsletter.is(":checked");
        var topics = $("#newsletter_topics")[inital ? "removeClass" : "addClass"]("gray");
        var topicInputs = topics.find("input").attr("disabled", !inital);
        // show when newsletter is checked
        newsletter.click(function() {
            topics[this.checked ? "removeClass" : "addClass"]("gray");
            topicInputs.attr("disabled", !this.checked);
        });
    });


}();
