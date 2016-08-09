# F.A.Q-Module-for-BlueThrut-Clan-CMS
<p> This is a faq module for the bluethrust cms script
    to install you would just upload the files and then do the following: <br/>
    <br/>
    <code> my account > Administrator Options > add console category > fill out the details. </code><br/>
    <br/>
    then after you did that you would add the files from <br/>
    <br/>
    <code> members/include/admin/faq/ folder </code><br/>
    <br/>
    to do this you would go to:<br/>
    <br/>
    <code> My account > Administrator Options > add console > fill out the details and then upload the file that you wanted to. then fill out the permissions. i normally have only the commander and co-commander </code><br/>
    <br/>
    if you did this you should see the following: <code> category for the faq > faq options </code><br>
    <br>
</p>
<p> you will have to edit out the numbers on these line of codes: <br/>
<code>$faqs->faq_cat(edit,delete);</code> <br/>
<code>$faqs->show_faq(edit,delete);</code><br/>
just change the numbers to the number representing the console ids. first number is edit, 2nd line is for delete.</p>
<p> Make sure to import faq.sql into phpmyadmin</p>
<p>P.S: Sorry I know this isn't a best written document. I barely release items out to the public. So I barely have to write documents for program or stuff i write.</p>
