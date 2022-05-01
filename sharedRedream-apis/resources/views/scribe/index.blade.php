<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta content="IE=edge,chrome=1" http-equiv="X-UA-Compatible">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>Shared Redream API</title>

    <link href="https://fonts.googleapis.com/css?family=PT+Sans&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset("/vendor/scribe/css/theme-default.style.css") }}" media="screen">
    <link rel="stylesheet" href="{{ asset("/vendor/scribe/css/theme-default.print.css") }}" media="print">

    <script src="https://cdn.jsdelivr.net/npm/lodash@4.17.10/lodash.min.js"></script>

    <link rel="stylesheet"
          href="https://unpkg.com/@highlightjs/cdn-assets@10.7.2/styles/obsidian.min.css">
    <script src="https://unpkg.com/@highlightjs/cdn-assets@10.7.2/highlight.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jets/0.14.1/jets.min.js"></script>

    <style id="language-style">
        /* starts out as display none and is replaced with js later  */
                    body .content .bash-example code { display: none; }
                    body .content .javascript-example code { display: none; }
                    body .content .php-example code { display: none; }
            </style>

    <script>
        var baseUrl = "http://localhost:8180";
        var useCsrf = Boolean(1);
        var csrfUrl = "/sanctum/csrf-cookie";
    </script>
    <script src="{{ asset("/vendor/scribe/js/tryitout-3.27.0.js") }}"></script>

    <script src="{{ asset("/vendor/scribe/js/theme-default-3.27.0.js") }}"></script>

</head>

<body data-languages="[&quot;bash&quot;,&quot;javascript&quot;,&quot;php&quot;]">

<a href="#" id="nav-button">
    <span>
        MENU
        <img src="{{ asset("/vendor/scribe/images/navbar.png") }}" alt="navbar-image" />
    </span>
</a>
<div class="tocify-wrapper">
    
            <div class="lang-selector">
                                            <button type="button" class="lang-button" data-language-name="bash">bash</button>
                                            <button type="button" class="lang-button" data-language-name="javascript">javascript</button>
                                            <button type="button" class="lang-button" data-language-name="php">php</button>
                    </div>
    
    <div class="search">
        <input type="text" class="search" id="input-search" placeholder="Search">
    </div>

    <div id="toc">
                                                                            <ul id="tocify-header-0" class="tocify-header">
                    <li class="tocify-item level-1" data-unique="introduction">
                        <a href="#introduction">Introduction</a>
                    </li>
                                            
                                                                    </ul>
                                                <ul id="tocify-header-1" class="tocify-header">
                    <li class="tocify-item level-1" data-unique="authenticating-requests">
                        <a href="#authenticating-requests">Authenticating requests</a>
                    </li>
                                            
                                                </ul>
                    
                    <ul id="tocify-header-2" class="tocify-header">
                <li class="tocify-item level-1" data-unique="auth-endpoints">
                    <a href="#auth-endpoints">Auth endpoints</a>
                </li>
                                    <ul id="tocify-subheader-auth-endpoints" class="tocify-subheader">
                                                    <li class="tocify-item level-2" data-unique="auth-endpoints-POSTregister">
                        <a href="#auth-endpoints-POSTregister">Registration request</a>
                    </li>
                                    <li class="tocify-item level-2" data-unique="auth-endpoints-POSTlogin">
                        <a href="#auth-endpoints-POSTlogin">Login request</a>
                    </li>
                                    <li class="tocify-item level-2" data-unique="auth-endpoints-GETprofile">
                        <a href="#auth-endpoints-GETprofile">Show authenticated user info</a>
                    </li>
                                                    </ul>
                            </ul>
                    <ul id="tocify-header-3" class="tocify-header">
                <li class="tocify-item level-1" data-unique="incident-endpoints">
                    <a href="#incident-endpoints">Incident endpoints</a>
                </li>
                                    <ul id="tocify-subheader-incident-endpoints" class="tocify-subheader">
                                                    <li class="tocify-item level-2" data-unique="incident-endpoints-GETincidents">
                        <a href="#incident-endpoints-GETincidents">Get all active incidents</a>
                    </li>
                                    <li class="tocify-item level-2" data-unique="incident-endpoints-GET-user_id--incidents">
                        <a href="#incident-endpoints-GET-user_id--incidents">Get all incidents from an USER</a>
                    </li>
                                    <li class="tocify-item level-2" data-unique="incident-endpoints-POSTincident">
                        <a href="#incident-endpoints-POSTincident">Create new incident</a>
                    </li>
                                    <li class="tocify-item level-2" data-unique="incident-endpoints-POSTincident--id--support">
                        <a href="#incident-endpoints-POSTincident--id--support">Support the incident</a>
                    </li>
                                    <li class="tocify-item level-2" data-unique="incident-endpoints-POSTincident--id--refund">
                        <a href="#incident-endpoints-POSTincident--id--refund">Refund the incident</a>
                    </li>
                                                    </ul>
                            </ul>
                    <ul id="tocify-header-4" class="tocify-header">
                <li class="tocify-item level-1" data-unique="transaction-endpoints">
                    <a href="#transaction-endpoints">Transaction endpoints</a>
                </li>
                                    <ul id="tocify-subheader-transaction-endpoints" class="tocify-subheader">
                                                    <li class="tocify-item level-2" data-unique="transaction-endpoints-GET-user_id--extract">
                        <a href="#transaction-endpoints-GET-user_id--extract">Get all transactions from an USER</a>
                    </li>
                                                    </ul>
                            </ul>
                    <ul id="tocify-header-5" class="tocify-header">
                <li class="tocify-item level-1" data-unique="voucher-endpoints">
                    <a href="#voucher-endpoints">Voucher endpoints</a>
                </li>
                                    <ul id="tocify-subheader-voucher-endpoints" class="tocify-subheader">
                                                    <li class="tocify-item level-2" data-unique="voucher-endpoints-POSTvoucher-create--count-">
                        <a href="#voucher-endpoints-POSTvoucher-create--count-">Generate new Vouchers</a>
                    </li>
                                    <li class="tocify-item level-2" data-unique="voucher-endpoints-POSTvoucher-redeem">
                        <a href="#voucher-endpoints-POSTvoucher-redeem">Redeem the voucher passing USER_ID</a>
                    </li>
                                    <li class="tocify-item level-2" data-unique="voucher-endpoints-GETvoucher">
                        <a href="#voucher-endpoints-GETvoucher">Get one token to redeem</a>
                    </li>
                                                    </ul>
                            </ul>
        
                        
            </div>

            <ul class="toc-footer" id="toc-footer">
                            <li><a href="{{ route("scribe.postman") }}">View Postman collection</a></li>
                            <li><a href="{{ route("scribe.openapi") }}">View OpenAPI spec</a></li>
                            <li><a href="http://github.com/knuckleswtf/scribe">Documentation powered by Scribe ✍</a></li>
                    </ul>
        <ul class="toc-footer" id="last-updated">
        <li>Last updated: April 30 2022</li>
    </ul>
</div>

<div class="page-wrapper">
    <div class="dark-box"></div>
    <div class="content">
        <h1 id="introduction">Introduction</h1>
<p>Shared Redream API - Redeem vouchers to help others!</p>
<p>This documentation aims to provide all the information you need to work with our API.</p>
<aside>As you scroll, you'll see code examples for working with the API in different programming languages in the dark area to the right (or as part of the content on mobile).
You can switch the language used with the tabs at the top right (or from the nav menu at the top left on mobile).</aside>
<blockquote>
<p>Base URL</p>
</blockquote>
<pre><code class="language-yaml">http://localhost:8180</code></pre>

        <h1 id="authenticating-requests">Authenticating requests</h1>
<p>Authenticate requests to this API's endpoints by sending an <strong><code>Authorization</code></strong> header with the value <strong><code>"Bearer {ACCESS_TOKEN}"</code></strong>.</p>
<p>All authenticated endpoints are marked with a <code>requires authentication</code> badge in the documentation below.</p>
<p>You can retrieve your token by  registering or logging in through <b>API endpoints</b>.</p>

        <h1 id="auth-endpoints">Auth endpoints</h1>

    

            <h2 id="auth-endpoints-POSTregister">Registration request</h2>

<p>
</p>



<span id="example-requests-POSTregister">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://localhost:8180/register" \
    --header "Content-Type: application/json" \
    --data "{
    \"name\": \"Demo\",
    \"email\": \"demo@demo.com\",
    \"password\": \"password\"
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost:8180/register"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "name": "Demo",
    "email": "demo@demo.com",
    "password": "password"
};

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>


<div class="php-example">
    <pre><code class="language-php">$client = new \GuzzleHttp\Client();
$response = $client-&gt;post(
    'http://localhost:8180/register',
    [
        'headers' =&gt; [
            'Content-Type' =&gt; 'application/json',
        ],
        'json' =&gt; [
            'name' =&gt; 'Demo',
            'email' =&gt; 'demo@demo.com',
            'password' =&gt; 'password',
        ],
    ]
);
$body = $response-&gt;getBody();
print_r(json_decode((string) $body));</code></pre></div>

</span>

<span id="example-responses-POSTregister">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <pre>

<code class="language-json">{
   &quot;data&quot;: {
       &quot;id&quot;: 2,
       &quot;name&quot;: &quot;Demo&quot;,
       &quot;email&quot;: &quot;demo@demo.com&quot;,
       &quot;balance&quot;: &quot;0.00&quot;
   }
   &quot;token&quot;: &quot;3|tA8Ouhh1CWXJORVPHvUQvN0SFNZVGwvVbx2F3prb&quot;,
   &quot;token_type&quot;: &quot;Bearer&quot;
}</code>
 </pre>
            <blockquote>
            <p>Example response (422, Validation error):</p>
        </blockquote>
                <pre>

<code class="language-json">{
    &quot;message&quot;: &quot;The given data was invalid.&quot;,
    &quot;errors&quot;: {
        &quot;email&quot;: [
            &quot;The email field is required.&quot;
        ]
    }
}</code>
 </pre>
    </span>
<span id="execution-results-POSTregister" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTregister"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTregister"></code></pre>
</span>
<span id="execution-error-POSTregister" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTregister"></code></pre>
</span>
<form id="form-POSTregister" data-method="POST"
      data-path="register"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      data-headers='{"Content-Type":"application\/json"}'
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTregister', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTregister"
                    onclick="tryItOut('POSTregister');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTregister"
                    onclick="cancelTryOut('POSTregister');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTregister" hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>register</code></b>
        </p>
                            <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <p>
            <b><code>name</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
                <input type="text"
               name="name"
               data-endpoint="POSTregister"
               value="Demo"
               data-component="body" hidden>
    <br>
<p>The name of the user.</p>
        </p>
                <p>
            <b><code>email</code></b>&nbsp;&nbsp;<small>email</small>  &nbsp;
                <input type="text"
               name="email"
               data-endpoint="POSTregister"
               value="demo@demo.com"
               data-component="body" hidden>
    <br>
<p>The email of the user.</p>
        </p>
                <p>
            <b><code>password</code></b>&nbsp;&nbsp;<small>password</small>  &nbsp;
                <input type="text"
               name="password"
               data-endpoint="POSTregister"
               value="password"
               data-component="body" hidden>
    <br>
<p>The password of the user.</p>
        </p>
        </form>

            <h2 id="auth-endpoints-POSTlogin">Login request</h2>

<p>
</p>



<span id="example-requests-POSTlogin">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://localhost:8180/login" \
    --header "Content-Type: application/json" \
    --data "{
    \"email\": \"demo@demo.com\",
    \"password\": \"password\"
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost:8180/login"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "email": "demo@demo.com",
    "password": "password"
};

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>


<div class="php-example">
    <pre><code class="language-php">$client = new \GuzzleHttp\Client();
$response = $client-&gt;post(
    'http://localhost:8180/login',
    [
        'headers' =&gt; [
            'Content-Type' =&gt; 'application/json',
        ],
        'json' =&gt; [
            'email' =&gt; 'demo@demo.com',
            'password' =&gt; 'password',
        ],
    ]
);
$body = $response-&gt;getBody();
print_r(json_decode((string) $body));</code></pre></div>

</span>

<span id="example-responses-POSTlogin">
            <blockquote>
            <p>Example response (422, Validation error):</p>
        </blockquote>
                <pre>

<code class="language-json">{
    &quot;message&quot;: &quot;The given data was invalid.&quot;,
    &quot;errors&quot;: {
        &quot;email&quot;: [
            &quot;The email field is required.&quot;
        ]
    }
}</code>
 </pre>
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <details class="annotation">
            <summary>
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
x-ratelimit-limit: 60
x-ratelimit-remaining: 59
access-control-allow-origin: *
 </code></pre>
        </details>         <pre>

<code class="language-json">{
    &quot;message&quot;: &quot;Hi Demo, welcome to sharedRedream&quot;,
    &quot;access_token&quot;: &quot;3|1bXGsJSE15YsUgNg1nFFA16nCgJ3xdW8wrOhhypN&quot;,
    &quot;token_type&quot;: &quot;Bearer&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-POSTlogin" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTlogin"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTlogin"></code></pre>
</span>
<span id="execution-error-POSTlogin" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTlogin"></code></pre>
</span>
<form id="form-POSTlogin" data-method="POST"
      data-path="login"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      data-headers='{"Content-Type":"application\/json"}'
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTlogin', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTlogin"
                    onclick="tryItOut('POSTlogin');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTlogin"
                    onclick="cancelTryOut('POSTlogin');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTlogin" hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>login</code></b>
        </p>
                            <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <p>
            <b><code>email</code></b>&nbsp;&nbsp;<small>email</small>  &nbsp;
                <input type="text"
               name="email"
               data-endpoint="POSTlogin"
               value="demo@demo.com"
               data-component="body" hidden>
    <br>
<p>The email of the user.</p>
        </p>
                <p>
            <b><code>password</code></b>&nbsp;&nbsp;<small>password</small>  &nbsp;
                <input type="text"
               name="password"
               data-endpoint="POSTlogin"
               value="password"
               data-component="body" hidden>
    <br>
<p>The password of the user.</p>
        </p>
        </form>

            <h2 id="auth-endpoints-GETprofile">Show authenticated user info</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-GETprofile">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost:8180/profile" \
    --header "Authorization: Bearer {ACCESS_TOKEN}" \
    --header "Content-Type: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost:8180/profile"
);

const headers = {
    "Authorization": "Bearer {ACCESS_TOKEN}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>


<div class="php-example">
    <pre><code class="language-php">$client = new \GuzzleHttp\Client();
$response = $client-&gt;get(
    'http://localhost:8180/profile',
    [
        'headers' =&gt; [
            'Authorization' =&gt; 'Bearer {ACCESS_TOKEN}',
            'Content-Type' =&gt; 'application/json',
        ],
    ]
);
$body = $response-&gt;getBody();
print_r(json_decode((string) $body));</code></pre></div>

</span>

<span id="example-responses-GETprofile">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <pre>

<code class="language-json">{
    &quot;id&quot;: 2,
    &quot;name&quot;: &quot;Demo&quot;,
    &quot;email&quot;: &quot;demo@demo.com&quot;,
    &quot;balance&quot;: &quot;150.00&quot;
}</code>
 </pre>
            <blockquote>
            <p>Example response (404, Not Found):</p>
        </blockquote>
                <pre>

<code class="language-json">{
    &quot;message&quot;: &quot;Not Found&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-GETprofile" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETprofile"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETprofile"></code></pre>
</span>
<span id="execution-error-GETprofile" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETprofile"></code></pre>
</span>
<form id="form-GETprofile" data-method="GET"
      data-path="profile"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      data-headers='{"Authorization":"Bearer {ACCESS_TOKEN}","Content-Type":"application\/json"}'
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETprofile', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETprofile"
                    onclick="tryItOut('GETprofile');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETprofile"
                    onclick="cancelTryOut('GETprofile');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETprofile" hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>profile</code></b>
        </p>
                <p>
            <label id="auth-GETprofile" hidden>Authorization header:
                <b><code>Bearer </code></b><input type="text"
                                                                name="Authorization"
                                                                data-prefix="Bearer "
                                                                data-endpoint="GETprofile"
                                                                data-component="header"></label>
        </p>
                </form>

        <h1 id="incident-endpoints">Incident endpoints</h1>

    

            <h2 id="incident-endpoints-GETincidents">Get all active incidents</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-GETincidents">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost:8180/incidents" \
    --header "Authorization: Bearer {ACCESS_TOKEN}" \
    --header "Content-Type: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost:8180/incidents"
);

const headers = {
    "Authorization": "Bearer {ACCESS_TOKEN}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>


<div class="php-example">
    <pre><code class="language-php">$client = new \GuzzleHttp\Client();
$response = $client-&gt;get(
    'http://localhost:8180/incidents',
    [
        'headers' =&gt; [
            'Authorization' =&gt; 'Bearer {ACCESS_TOKEN}',
            'Content-Type' =&gt; 'application/json',
        ],
    ]
);
$body = $response-&gt;getBody();
print_r(json_decode((string) $body));</code></pre></div>

</span>

<span id="example-responses-GETincidents">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <pre>

<code class="language-json">{
    &quot;data&quot;: {
        &quot;id&quot;: 2,
        &quot;title&quot;: &quot;Help my Cats&quot;,
        &quot;description&quot;: &quot;Need help to feed my cats please&quot;,
        &quot;owner&quot;: &quot;CatFan&quot;,
        &quot;total_raised&quot;: &quot;170.00&quot;,
        &quot;goal&quot;: &quot;500.00&quot;,
        &quot;expires_at&quot;: &quot;28-05-2022&quot;,
        &quot;created_at&quot;: &quot;28-04-2022 15:46:21&quot;,
        &quot;transactions&quot;: [
            {
                &quot;operation&quot;: &quot;incident_help&quot;,
                &quot;user&quot;: &quot;John&quot;,
                &quot;value&quot;: &quot;55.00&quot;
            },
            {
                &quot;operation&quot;: &quot;incident_help&quot;,
                &quot;user&quot;: &quot;Alex&quot;,
                &quot;value&quot;: &quot;45.00&quot;
            },
            {
                &quot;operation&quot;: &quot;incident_help&quot;,
                &quot;user&quot;: &quot;Doug&quot;,
                &quot;value&quot;: &quot;70.00&quot;
            }
        ]
    }
}</code>
 </pre>
    </span>
<span id="execution-results-GETincidents" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETincidents"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETincidents"></code></pre>
</span>
<span id="execution-error-GETincidents" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETincidents"></code></pre>
</span>
<form id="form-GETincidents" data-method="GET"
      data-path="incidents"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      data-headers='{"Authorization":"Bearer {ACCESS_TOKEN}","Content-Type":"application\/json"}'
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETincidents', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETincidents"
                    onclick="tryItOut('GETincidents');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETincidents"
                    onclick="cancelTryOut('GETincidents');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETincidents" hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>incidents</code></b>
        </p>
                <p>
            <label id="auth-GETincidents" hidden>Authorization header:
                <b><code>Bearer </code></b><input type="text"
                                                                name="Authorization"
                                                                data-prefix="Bearer "
                                                                data-endpoint="GETincidents"
                                                                data-component="header"></label>
        </p>
                </form>

            <h2 id="incident-endpoints-GET-user_id--incidents">Get all incidents from an USER</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-GET-user_id--incidents">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost:8180/quia/incidents" \
    --header "Authorization: Bearer {ACCESS_TOKEN}" \
    --header "Content-Type: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost:8180/quia/incidents"
);

const headers = {
    "Authorization": "Bearer {ACCESS_TOKEN}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>


<div class="php-example">
    <pre><code class="language-php">$client = new \GuzzleHttp\Client();
$response = $client-&gt;get(
    'http://localhost:8180/quia/incidents',
    [
        'headers' =&gt; [
            'Authorization' =&gt; 'Bearer {ACCESS_TOKEN}',
            'Content-Type' =&gt; 'application/json',
        ],
    ]
);
$body = $response-&gt;getBody();
print_r(json_decode((string) $body));</code></pre></div>

</span>

<span id="example-responses-GET-user_id--incidents">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <pre>

<code class="language-json">{
    &quot;data&quot;: {
        &quot;id&quot;: 2,
        &quot;title&quot;: &quot;Help my Cats&quot;,
        &quot;description&quot;: &quot;Need help to feed my cats please&quot;,
        &quot;owner&quot;: &quot;CatFan&quot;,
        &quot;total_raised&quot;: &quot;170.00&quot;,
        &quot;goal&quot;: &quot;500.00&quot;,
        &quot;expires_at&quot;: &quot;28-05-2022&quot;,
        &quot;created_at&quot;: &quot;28-04-2022 15:46:21&quot;,
        &quot;transactions&quot;: [
            {
                &quot;operation&quot;: &quot;incident_help&quot;,
                &quot;user&quot;: &quot;John&quot;,
                &quot;value&quot;: &quot;55.00&quot;
            },
            {
                &quot;operation&quot;: &quot;incident_help&quot;,
                &quot;user&quot;: &quot;Alex&quot;,
                &quot;value&quot;: &quot;45.00&quot;
            },
            {
                &quot;operation&quot;: &quot;incident_help&quot;,
                &quot;user&quot;: &quot;Doug&quot;,
                &quot;value&quot;: &quot;70.00&quot;
            }
        ]
    }
}</code>
 </pre>
    </span>
<span id="execution-results-GET-user_id--incidents" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GET-user_id--incidents"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GET-user_id--incidents"></code></pre>
</span>
<span id="execution-error-GET-user_id--incidents" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GET-user_id--incidents"></code></pre>
</span>
<form id="form-GET-user_id--incidents" data-method="GET"
      data-path="{user_id}/incidents"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      data-headers='{"Authorization":"Bearer {ACCESS_TOKEN}","Content-Type":"application\/json"}'
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GET-user_id--incidents', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GET-user_id--incidents"
                    onclick="tryItOut('GET-user_id--incidents');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GET-user_id--incidents"
                    onclick="cancelTryOut('GET-user_id--incidents');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GET-user_id--incidents" hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>{user_id}/incidents</code></b>
        </p>
                <p>
            <label id="auth-GET-user_id--incidents" hidden>Authorization header:
                <b><code>Bearer </code></b><input type="text"
                                                                name="Authorization"
                                                                data-prefix="Bearer "
                                                                data-endpoint="GET-user_id--incidents"
                                                                data-component="header"></label>
        </p>
                <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <p>
                <b><code>user_id</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
                <input type="text"
               name="user_id"
               data-endpoint="GET-user_id--incidents"
               value="quia"
               data-component="url" hidden>
    <br>
<p>The ID of the user.</p>
            </p>
                    </form>

            <h2 id="incident-endpoints-POSTincident">Create new incident</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-POSTincident">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://localhost:8180/incident" \
    --header "Authorization: Bearer {ACCESS_TOKEN}" \
    --header "Content-Type: application/json" \
    --data "{
    \"title\": \"Need help\",
    \"description\": \"Need help for something..\",
    \"goal\": 274939.15,
    \"user_id\": 2,
    \"expires_at\": \"2029-09-30\"
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost:8180/incident"
);

const headers = {
    "Authorization": "Bearer {ACCESS_TOKEN}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "title": "Need help",
    "description": "Need help for something..",
    "goal": 274939.15,
    "user_id": 2,
    "expires_at": "2029-09-30"
};

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>


<div class="php-example">
    <pre><code class="language-php">$client = new \GuzzleHttp\Client();
$response = $client-&gt;post(
    'http://localhost:8180/incident',
    [
        'headers' =&gt; [
            'Authorization' =&gt; 'Bearer {ACCESS_TOKEN}',
            'Content-Type' =&gt; 'application/json',
        ],
        'json' =&gt; [
            'title' =&gt; 'Need help',
            'description' =&gt; 'Need help for something..',
            'goal' =&gt; 274939.15,
            'user_id' =&gt; 2,
            'expires_at' =&gt; '2029-09-30',
        ],
    ]
);
$body = $response-&gt;getBody();
print_r(json_decode((string) $body));</code></pre></div>

</span>

<span id="example-responses-POSTincident">
            <blockquote>
            <p>Example response (201):</p>
        </blockquote>
                <pre>

<code class="language-json">{
    &quot;data&quot;: {
        &quot;title&quot;: &quot;Help my Cats&quot;,
        &quot;description&quot;: &quot;Need help to feed my cats please&quot;,
        &quot;owner&quot;: &quot;CatFan&quot;,
        &quot;total_raised&quot;: 0,
        &quot;goal&quot;: &quot;500.00&quot;,
        &quot;expires_at&quot;: &quot;28-05-2022&quot;,
        &quot;created_at&quot;: &quot;28-04-2022 15:46:21&quot;,
        &quot;transactions&quot;: []
    }
}</code>
 </pre>
            <blockquote>
            <p>Example response (422, Validation error):</p>
        </blockquote>
                <pre>

<code class="language-json">{
    &quot;message&quot;: &quot;The given data was invalid.&quot;,
    &quot;errors&quot;: {
        &quot;description&quot;: [
            &quot;The description field is required.&quot;
        ]
    }
}</code>
 </pre>
    </span>
<span id="execution-results-POSTincident" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTincident"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTincident"></code></pre>
</span>
<span id="execution-error-POSTincident" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTincident"></code></pre>
</span>
<form id="form-POSTincident" data-method="POST"
      data-path="incident"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      data-headers='{"Authorization":"Bearer {ACCESS_TOKEN}","Content-Type":"application\/json"}'
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTincident', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTincident"
                    onclick="tryItOut('POSTincident');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTincident"
                    onclick="cancelTryOut('POSTincident');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTincident" hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>incident</code></b>
        </p>
                <p>
            <label id="auth-POSTincident" hidden>Authorization header:
                <b><code>Bearer </code></b><input type="text"
                                                                name="Authorization"
                                                                data-prefix="Bearer "
                                                                data-endpoint="POSTincident"
                                                                data-component="header"></label>
        </p>
                        <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <p>
            <b><code>title</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
                <input type="text"
               name="title"
               data-endpoint="POSTincident"
               value="Need help"
               data-component="body" hidden>
    <br>
<p>The title of the incident.</p>
        </p>
                <p>
            <b><code>description</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
                <input type="text"
               name="description"
               data-endpoint="POSTincident"
               value="Need help for something.."
               data-component="body" hidden>
    <br>
<p>The description of the incident.</p>
        </p>
                <p>
            <b><code>goal</code></b>&nbsp;&nbsp;<small>number</small>  &nbsp;
                <input type="number"
               name="goal"
               data-endpoint="POSTincident"
               value="274939.15"
               data-component="body" hidden>
    <br>

        </p>
                <p>
            <b><code>user_id</code></b>&nbsp;&nbsp;<small>integer</small>  &nbsp;
                <input type="number"
               name="user_id"
               data-endpoint="POSTincident"
               value="2"
               data-component="body" hidden>
    <br>
<p>The id of the user trying to create the incident.</p>
        </p>
                <p>
            <b><code>expires_at</code></b>&nbsp;&nbsp;<small>string</small>     <i>optional</i> &nbsp;
                <input type="text"
               name="expires_at"
               data-endpoint="POSTincident"
               value="2029-09-30"
               data-component="body" hidden>
    <br>
<p>Must be a valid date. Must be a date after <code>today</code>.</p>
        </p>
        </form>

            <h2 id="incident-endpoints-POSTincident--id--support">Support the incident</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>

<p>The user can help donating some value to an incident</p>

<span id="example-requests-POSTincident--id--support">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://localhost:8180/incident/3/support" \
    --header "Authorization: Bearer {ACCESS_TOKEN}" \
    --header "Content-Type: application/json" \
    --data "{
    \"user_id\": 2,
    \"value\": 40
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost:8180/incident/3/support"
);

const headers = {
    "Authorization": "Bearer {ACCESS_TOKEN}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "user_id": 2,
    "value": 40
};

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>


<div class="php-example">
    <pre><code class="language-php">$client = new \GuzzleHttp\Client();
$response = $client-&gt;post(
    'http://localhost:8180/incident/3/support',
    [
        'headers' =&gt; [
            'Authorization' =&gt; 'Bearer {ACCESS_TOKEN}',
            'Content-Type' =&gt; 'application/json',
        ],
        'json' =&gt; [
            'user_id' =&gt; 2,
            'value' =&gt; 40,
        ],
    ]
);
$body = $response-&gt;getBody();
print_r(json_decode((string) $body));</code></pre></div>

</span>

<span id="example-responses-POSTincident--id--support">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <pre>

<code class="language-json">{
    &quot;data&quot;: {
        &quot;title&quot;: &quot;Help my Cats&quot;,
        &quot;description&quot;: &quot;Need help to feed my cats please&quot;,
        &quot;owner&quot;: &quot;CatFan&quot;,
        &quot;total_raised&quot;: 45,
        &quot;created_at&quot;: &quot;28-04-2022 15:46:21&quot;,
        &quot;transactions&quot;: [
            {
                &quot;operation&quot;: &quot;incident_help&quot;,
                &quot;user&quot;: &quot;Alex&quot;,
                &quot;value&quot;: &quot;45.00&quot;
            }
        ]
    }
}</code>
 </pre>
            <blockquote>
            <p>Example response (422, Validation error):</p>
        </blockquote>
                <pre>

<code class="language-json">{
    &quot;message&quot;: &quot;The given data was invalid.&quot;,
    &quot;errors&quot;: {
        &quot;value&quot;: [
            &quot;The value field is required.&quot;
        ]
    }
}</code>
 </pre>
            <blockquote>
            <p>Example response (422, Not enouth money):</p>
        </blockquote>
                <pre>

<code class="language-json">{
    &quot;error&quot;: &quot;Balance is not enought&quot;,
    &quot;code&quot;: 422
}</code>
 </pre>
            <blockquote>
            <p>Example response (404, Incident not found):</p>
        </blockquote>
                <pre>

<code class="language-json">{
    &quot;message&quot;: &quot;Incident does not exist&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-POSTincident--id--support" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTincident--id--support"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTincident--id--support"></code></pre>
</span>
<span id="execution-error-POSTincident--id--support" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTincident--id--support"></code></pre>
</span>
<form id="form-POSTincident--id--support" data-method="POST"
      data-path="incident/{id}/support"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      data-headers='{"Authorization":"Bearer {ACCESS_TOKEN}","Content-Type":"application\/json"}'
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTincident--id--support', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTincident--id--support"
                    onclick="tryItOut('POSTincident--id--support');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTincident--id--support"
                    onclick="cancelTryOut('POSTincident--id--support');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTincident--id--support" hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>incident/{id}/support</code></b>
        </p>
                <p>
            <label id="auth-POSTincident--id--support" hidden>Authorization header:
                <b><code>Bearer </code></b><input type="text"
                                                                name="Authorization"
                                                                data-prefix="Bearer "
                                                                data-endpoint="POSTincident--id--support"
                                                                data-component="header"></label>
        </p>
                <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <p>
                <b><code>id</code></b>&nbsp;&nbsp;<small>integer</small>  &nbsp;
                <input type="number"
               name="id"
               data-endpoint="POSTincident--id--support"
               value="3"
               data-component="url" hidden>
    <br>
<p>The ID of the incident.</p>
            </p>
                            <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <p>
            <b><code>user_id</code></b>&nbsp;&nbsp;<small>integer</small>  &nbsp;
                <input type="number"
               name="user_id"
               data-endpoint="POSTincident--id--support"
               value="2"
               data-component="body" hidden>
    <br>
<p>The id of the user trying to support the incident.</p>
        </p>
                <p>
            <b><code>value</code></b>&nbsp;&nbsp;<small>integer</small>  &nbsp;
                <input type="number"
               name="value"
               data-endpoint="POSTincident--id--support"
               value="40"
               data-component="body" hidden>
    <br>
<p>The value amount deposit by the user to help incident.</p>
        </p>
        </form>

            <h2 id="incident-endpoints-POSTincident--id--refund">Refund the incident</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>

<p>Refunds the total raised to the owner of the incident.</p>

<span id="example-requests-POSTincident--id--refund">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://localhost:8180/incident/20/refund" \
    --header "Authorization: Bearer {ACCESS_TOKEN}" \
    --header "Content-Type: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost:8180/incident/20/refund"
);

const headers = {
    "Authorization": "Bearer {ACCESS_TOKEN}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers,
}).then(response =&gt; response.json());</code></pre></div>


<div class="php-example">
    <pre><code class="language-php">$client = new \GuzzleHttp\Client();
$response = $client-&gt;post(
    'http://localhost:8180/incident/20/refund',
    [
        'headers' =&gt; [
            'Authorization' =&gt; 'Bearer {ACCESS_TOKEN}',
            'Content-Type' =&gt; 'application/json',
        ],
    ]
);
$body = $response-&gt;getBody();
print_r(json_decode((string) $body));</code></pre></div>

</span>

<span id="example-responses-POSTincident--id--refund">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <pre>

<code class="language-json">{
    &quot;data&quot;: {
        &quot;title&quot;: &quot;Help my Cats&quot;,
        &quot;description&quot;: &quot;Need help to feed my cats please&quot;,
        &quot;owner&quot;: &quot;CatFan&quot;,
        &quot;total_raised&quot;: 45,
        &quot;created_at&quot;: &quot;28-04-2022 15:46:21&quot;,
        &quot;transactions&quot;: [
            {
                &quot;operation&quot;: &quot;incident_help&quot;,
                &quot;user&quot;: &quot;Alex&quot;,
                &quot;value&quot;: &quot;45.00&quot;
            },
            {
                &quot;operation&quot;: &quot;incident_refund&quot;,
                &quot;user&quot;: &quot;CatFan&quot;,
                &quot;value&quot;: &quot;45.00&quot;
            }
        ]
    }
}</code>
 </pre>
            <blockquote>
            <p>Example response (403, Not authorized user trying to perform):</p>
        </blockquote>
                <pre>

<code class="language-json">{
    &quot;error&quot;: &quot;This action is not allowed&quot;,
    &quot;code&quot;: 403
}</code>
 </pre>
            <blockquote>
            <p>Example response (404, Incident not found):</p>
        </blockquote>
                <pre>

<code class="language-json">{
    &quot;message&quot;: &quot;Incident does not exist&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-POSTincident--id--refund" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTincident--id--refund"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTincident--id--refund"></code></pre>
</span>
<span id="execution-error-POSTincident--id--refund" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTincident--id--refund"></code></pre>
</span>
<form id="form-POSTincident--id--refund" data-method="POST"
      data-path="incident/{id}/refund"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      data-headers='{"Authorization":"Bearer {ACCESS_TOKEN}","Content-Type":"application\/json"}'
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTincident--id--refund', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTincident--id--refund"
                    onclick="tryItOut('POSTincident--id--refund');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTincident--id--refund"
                    onclick="cancelTryOut('POSTincident--id--refund');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTincident--id--refund" hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>incident/{id}/refund</code></b>
        </p>
                <p>
            <label id="auth-POSTincident--id--refund" hidden>Authorization header:
                <b><code>Bearer </code></b><input type="text"
                                                                name="Authorization"
                                                                data-prefix="Bearer "
                                                                data-endpoint="POSTincident--id--refund"
                                                                data-component="header"></label>
        </p>
                <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <p>
                <b><code>id</code></b>&nbsp;&nbsp;<small>integer</small>  &nbsp;
                <input type="number"
               name="id"
               data-endpoint="POSTincident--id--refund"
               value="20"
               data-component="url" hidden>
    <br>
<p>The ID of the incident.</p>
            </p>
                    </form>

        <h1 id="transaction-endpoints">Transaction endpoints</h1>

    

            <h2 id="transaction-endpoints-GET-user_id--extract">Get all transactions from an USER</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-GET-user_id--extract">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost:8180/expedita/extract" \
    --header "Authorization: Bearer {ACCESS_TOKEN}" \
    --header "Content-Type: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost:8180/expedita/extract"
);

const headers = {
    "Authorization": "Bearer {ACCESS_TOKEN}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>


<div class="php-example">
    <pre><code class="language-php">$client = new \GuzzleHttp\Client();
$response = $client-&gt;get(
    'http://localhost:8180/expedita/extract',
    [
        'headers' =&gt; [
            'Authorization' =&gt; 'Bearer {ACCESS_TOKEN}',
            'Content-Type' =&gt; 'application/json',
        ],
    ]
);
$body = $response-&gt;getBody();
print_r(json_decode((string) $body));</code></pre></div>

</span>

<span id="example-responses-GET-user_id--extract">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <pre>

<code class="language-json">{
   &quot;data&quot;: [
    {
       &quot;operation&quot;: &quot;voucher_redeem&quot;,
       &quot;redeem_voucher_id&quot;: 6,
       &quot;value&quot;: &quot;100.00&quot;
    },
    {
       &quot;operation&quot;: &quot;incident_help&quot;,
       &quot;incident_id&quot;: 2,
       &quot;value&quot;: &quot;30.00&quot;
    },
    {
       &quot;operation&quot;: &quot;incident_help&quot;,
       &quot;incident_id&quot;: 3,
       &quot;value&quot;: &quot;20.00&quot;
    }
}</code>
 </pre>
            <blockquote>
            <p>Example response (403, Not authorized user trying to perform):</p>
        </blockquote>
                <pre>

<code class="language-json">{
    &quot;error&quot;: &quot;This action is not allowed&quot;,
    &quot;code&quot;: 403
}</code>
 </pre>
    </span>
<span id="execution-results-GET-user_id--extract" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GET-user_id--extract"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GET-user_id--extract"></code></pre>
</span>
<span id="execution-error-GET-user_id--extract" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GET-user_id--extract"></code></pre>
</span>
<form id="form-GET-user_id--extract" data-method="GET"
      data-path="{user_id}/extract"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      data-headers='{"Authorization":"Bearer {ACCESS_TOKEN}","Content-Type":"application\/json"}'
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GET-user_id--extract', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GET-user_id--extract"
                    onclick="tryItOut('GET-user_id--extract');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GET-user_id--extract"
                    onclick="cancelTryOut('GET-user_id--extract');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GET-user_id--extract" hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>{user_id}/extract</code></b>
        </p>
                <p>
            <label id="auth-GET-user_id--extract" hidden>Authorization header:
                <b><code>Bearer </code></b><input type="text"
                                                                name="Authorization"
                                                                data-prefix="Bearer "
                                                                data-endpoint="GET-user_id--extract"
                                                                data-component="header"></label>
        </p>
                <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <p>
                <b><code>user_id</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
                <input type="text"
               name="user_id"
               data-endpoint="GET-user_id--extract"
               value="expedita"
               data-component="url" hidden>
    <br>
<p>The ID of the user.</p>
            </p>
                    </form>

        <h1 id="voucher-endpoints">Voucher endpoints</h1>

    

            <h2 id="voucher-endpoints-POSTvoucher-create--count-">Generate new Vouchers</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>

<p>I know, in real world this end point would be available only for admin user type, but.. yeah..
Lets keep this way, just to make faster to test</p>

<span id="example-requests-POSTvoucher-create--count-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://localhost:8180/voucher/create/doloribus" \
    --header "Authorization: Bearer {ACCESS_TOKEN}" \
    --header "Content-Type: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost:8180/voucher/create/doloribus"
);

const headers = {
    "Authorization": "Bearer {ACCESS_TOKEN}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers,
}).then(response =&gt; response.json());</code></pre></div>


<div class="php-example">
    <pre><code class="language-php">$client = new \GuzzleHttp\Client();
$response = $client-&gt;post(
    'http://localhost:8180/voucher/create/doloribus',
    [
        'headers' =&gt; [
            'Authorization' =&gt; 'Bearer {ACCESS_TOKEN}',
            'Content-Type' =&gt; 'application/json',
        ],
    ]
);
$body = $response-&gt;getBody();
print_r(json_decode((string) $body));</code></pre></div>

</span>

<span id="example-responses-POSTvoucher-create--count-">
            <blockquote>
            <p>Example response (201):</p>
        </blockquote>
                <pre>

<code class="language-json">{
    &quot;message&quot;: &quot;Vouchers Created&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-POSTvoucher-create--count-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTvoucher-create--count-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTvoucher-create--count-"></code></pre>
</span>
<span id="execution-error-POSTvoucher-create--count-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTvoucher-create--count-"></code></pre>
</span>
<form id="form-POSTvoucher-create--count-" data-method="POST"
      data-path="voucher/create/{count}"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      data-headers='{"Authorization":"Bearer {ACCESS_TOKEN}","Content-Type":"application\/json"}'
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTvoucher-create--count-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTvoucher-create--count-"
                    onclick="tryItOut('POSTvoucher-create--count-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTvoucher-create--count-"
                    onclick="cancelTryOut('POSTvoucher-create--count-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTvoucher-create--count-" hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>voucher/create/{count}</code></b>
        </p>
                <p>
            <label id="auth-POSTvoucher-create--count-" hidden>Authorization header:
                <b><code>Bearer </code></b><input type="text"
                                                                name="Authorization"
                                                                data-prefix="Bearer "
                                                                data-endpoint="POSTvoucher-create--count-"
                                                                data-component="header"></label>
        </p>
                <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <p>
                <b><code>count</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
                <input type="text"
               name="count"
               data-endpoint="POSTvoucher-create--count-"
               value="doloribus"
               data-component="url" hidden>
    <br>

            </p>
                    </form>

            <h2 id="voucher-endpoints-POSTvoucher-redeem">Redeem the voucher passing USER_ID</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>

<p>The user gets the value in his wallet and can start to help others</p>

<span id="example-requests-POSTvoucher-redeem">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://localhost:8180/voucher/redeem" \
    --header "Authorization: Bearer {ACCESS_TOKEN}" \
    --header "Content-Type: application/json" \
    --data "{
    \"token\": \"BW9JREEVNH181H54ISMK\",
    \"user_id\": 2
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost:8180/voucher/redeem"
);

const headers = {
    "Authorization": "Bearer {ACCESS_TOKEN}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "token": "BW9JREEVNH181H54ISMK",
    "user_id": 2
};

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>


<div class="php-example">
    <pre><code class="language-php">$client = new \GuzzleHttp\Client();
$response = $client-&gt;post(
    'http://localhost:8180/voucher/redeem',
    [
        'headers' =&gt; [
            'Authorization' =&gt; 'Bearer {ACCESS_TOKEN}',
            'Content-Type' =&gt; 'application/json',
        ],
        'json' =&gt; [
            'token' =&gt; 'BW9JREEVNH181H54ISMK',
            'user_id' =&gt; 2,
        ],
    ]
);
$body = $response-&gt;getBody();
print_r(json_decode((string) $body));</code></pre></div>

</span>

<span id="example-responses-POSTvoucher-redeem">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <pre>

<code class="language-json">{
    &quot;data&quot;: {
        &quot;token&quot;: &quot;S49SC89I34BC3S0KJRJM&quot;,
        &quot;user_id&quot;: 2,
        &quot;value&quot;: 100,
        &quot;used_at&quot;: &quot;28-04-2022 15:46:21&quot;
    }
}</code>
 </pre>
            <blockquote>
            <p>Example response (422, Validation error):</p>
        </blockquote>
                <pre>

<code class="language-json">{
    &quot;message&quot;: &quot;The given data was invalid.&quot;,
    &quot;errors&quot;: {
        &quot;token&quot;: [
            &quot;The token must be at least 20 characters.&quot;
        ]
    }
}</code>
 </pre>
            <blockquote>
            <p>Example response (403, Not authorized user trying to perform):</p>
        </blockquote>
                <pre>

<code class="language-json">{
    &quot;error&quot;: &quot;This action is not allowed&quot;,
    &quot;code&quot;: 403
}</code>
 </pre>
    </span>
<span id="execution-results-POSTvoucher-redeem" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTvoucher-redeem"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTvoucher-redeem"></code></pre>
</span>
<span id="execution-error-POSTvoucher-redeem" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTvoucher-redeem"></code></pre>
</span>
<form id="form-POSTvoucher-redeem" data-method="POST"
      data-path="voucher/redeem"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      data-headers='{"Authorization":"Bearer {ACCESS_TOKEN}","Content-Type":"application\/json"}'
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTvoucher-redeem', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTvoucher-redeem"
                    onclick="tryItOut('POSTvoucher-redeem');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTvoucher-redeem"
                    onclick="cancelTryOut('POSTvoucher-redeem');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTvoucher-redeem" hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>voucher/redeem</code></b>
        </p>
                <p>
            <label id="auth-POSTvoucher-redeem" hidden>Authorization header:
                <b><code>Bearer </code></b><input type="text"
                                                                name="Authorization"
                                                                data-prefix="Bearer "
                                                                data-endpoint="POSTvoucher-redeem"
                                                                data-component="header"></label>
        </p>
                        <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <p>
            <b><code>token</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
                <input type="text"
               name="token"
               data-endpoint="POSTvoucher-redeem"
               value="BW9JREEVNH181H54ISMK"
               data-component="body" hidden>
    <br>
<p>The token with 20 characters to be redeem.</p>
        </p>
                <p>
            <b><code>user_id</code></b>&nbsp;&nbsp;<small>integer</small>  &nbsp;
                <input type="number"
               name="user_id"
               data-endpoint="POSTvoucher-redeem"
               value="2"
               data-component="body" hidden>
    <br>
<p>The id of the user.</p>
        </p>
        </form>

            <h2 id="voucher-endpoints-GETvoucher">Get one token to redeem</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>

<p>Just to test it quick, lets get one token number</p>

<span id="example-requests-GETvoucher">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost:8180/voucher" \
    --header "Authorization: Bearer {ACCESS_TOKEN}" \
    --header "Content-Type: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost:8180/voucher"
);

const headers = {
    "Authorization": "Bearer {ACCESS_TOKEN}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>


<div class="php-example">
    <pre><code class="language-php">$client = new \GuzzleHttp\Client();
$response = $client-&gt;get(
    'http://localhost:8180/voucher',
    [
        'headers' =&gt; [
            'Authorization' =&gt; 'Bearer {ACCESS_TOKEN}',
            'Content-Type' =&gt; 'application/json',
        ],
    ]
);
$body = $response-&gt;getBody();
print_r(json_decode((string) $body));</code></pre></div>

</span>

<span id="example-responses-GETvoucher">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <pre>

<code class="language-json">{
    &quot;data&quot;: {
        &quot;token&quot;: &quot;S49SC89I34BC3S0KJRJM&quot;,
        &quot;value&quot;: 100
    }
}</code>
 </pre>
            <blockquote>
            <p>Example response (404, Not found):</p>
        </blockquote>
                <pre>

<code class="language-json">{
    &quot;message&quot;: &quot;We're out of token&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-GETvoucher" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETvoucher"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETvoucher"></code></pre>
</span>
<span id="execution-error-GETvoucher" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETvoucher"></code></pre>
</span>
<form id="form-GETvoucher" data-method="GET"
      data-path="voucher"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      data-headers='{"Authorization":"Bearer {ACCESS_TOKEN}","Content-Type":"application\/json"}'
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETvoucher', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETvoucher"
                    onclick="tryItOut('GETvoucher');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETvoucher"
                    onclick="cancelTryOut('GETvoucher');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETvoucher" hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>voucher</code></b>
        </p>
                <p>
            <label id="auth-GETvoucher" hidden>Authorization header:
                <b><code>Bearer </code></b><input type="text"
                                                                name="Authorization"
                                                                data-prefix="Bearer "
                                                                data-endpoint="GETvoucher"
                                                                data-component="header"></label>
        </p>
                </form>

    

        
    </div>
    <div class="dark-box">
                    <div class="lang-selector">
                                                        <button type="button" class="lang-button" data-language-name="bash">bash</button>
                                                        <button type="button" class="lang-button" data-language-name="javascript">javascript</button>
                                                        <button type="button" class="lang-button" data-language-name="php">php</button>
                            </div>
            </div>
</div>
</body>
</html>
