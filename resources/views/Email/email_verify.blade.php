<table style="font-family: 'Helvetica Neue',Helvetica,Arial,'Lucida Grande',sans-serif;border: solid lightgray 1px; background-color: transparent; max-width: 450px; margin:  0px auto" cellpadding="0" cellspacing="0">
    <tbody>
        <tr>
            <td style="text-align: center">
                <img src="{{url("/")}}/assets/img/mujib_100_logo.jpg" style="width: 300px; margin-bottom: 30px;"/>
            </td>
        </tr>

        <tr>

            <td style="padding: 10px; text-align: justify">
                <p>প্রিয় {{$details['name']}},<br/><br/>

                    শেখ রাসেল কুইজ এ “<strong>গ্রুপ {{$details['group']}}</strong>” তে নিবন্ধনের জন্য আপনাকে ধন্যবাদ। আপনার অ‌্যাকাউন্টটি সচল করার জন্য আমাদের আপনার ইমেলটি নিশ্চিত করতে হবে। আপনার ইমেল ঠিকানাটি নিশ্চিত করতে এবং  শেখ রাসেল কুইজ এ অংশ হতে নীচের বাটনে ক্লিক করুন। 

                </p>


                <a href="{{route('email_verify',['id'=>$details['id'],'code'=>$details['code']])}}" style=" color: #000; display: block; background-color: yellow; margin: 30px auto; text-decoration: none; font-size: 1.5rem; text-align: center; padding: 10px 0px; width: 90%; border-radius: 10px;">ইমেল ঠিকানাটি নিশ্চিত করুন</a>

                <p>
                    যদি বাটন কাজ না করে তবে নিচের লিংকটি ব‌্যবহার করুন।:<br/>
                    {{route('email_verify',['id'=>$details['id'],'code'=>$details['code']])}}
                </p>
                <p>
                    যদি কোন ধরণের সমস‌্যার সম্মুখিন হন তবে এই ইমেইলে যোগাযোগ করুন। 
                </p>

                <p>ধন‌্যবাদান্তে<br/>শেখ রাসেল কুইজ সাপোর্ট টিম</p>
            </td>

        </tr>
        <tr>

            <td>
<!--                <img src="{{url("/")}}/assets/img/email_footer.png" style="width: 100%"/>-->
            </td>

        </tr>
    </tbody>
</table>