<h1 style="text-align: center">Welcome to Hassan Wehbe's Interview Assignment</h1>
<br><br><br>
<div>
    <p style="margin-left: 30px">
        This is a simple php project that filters a list of offers fetched from an 
    api link
    </p>
    <p style="margin-left: 30px">
        This project can be run either as a web interface or as a CLI script
    </p>
</div>
<h3>1- CLI Script</h3>
<div style="margin-left: 30px">
        <p>
            To run the CLI  script, simply call the run.php file as stated in the assignment documentation
        </p>    
        <h6>Example:</h6>
<pre>
    php .\run.php count_by_offer_id 123
                    OR
    php .\run.php count_by_price_range 12 300
</pre>
        <h5 style="color: red">Note: </h5>
        <p>Before running the above scripts please make sure to run the following script in an another terminal to serve the web api</p>
        <pre>   php .\run.php web</pre>
</div>
<br><br><br>
<h3>2- Web Interface</h3>
<div style="margin-left: 30px">
    <p>Simply run the below command and navigate to 127.0.0.1 in your browser</p>
    <pre>   php .\run.php web</pre>
</div>
<br><br><br>

<div>
    <p>
        Each request to "getOffer.php" & "run.php" is logged in the logs folder according to the day date and -cli postfix if it was done by the CLI
    </p>
</div>
<br>
<div>
    <p>
        run ./test.php to test multiple cases of the cli script, and the results will appear in the log file
    </p>
</div>

<br><br><br>
<div style="text-align: center">
    <h6>Done By: </h6><h5>Hassan Wehbe</h5>
</div>

