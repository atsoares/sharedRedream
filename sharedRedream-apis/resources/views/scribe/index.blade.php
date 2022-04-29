<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta content="IE=edge,chrome=1" http-equiv="X-UA-Compatible">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>Shared Redream API</title>

    <link href="https://fonts.googleapis.com/css?family=PT+Sans&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset("vendor/scribe/css/theme-default.style.css") }}" media="screen">
    <link rel="stylesheet" href="{{ asset("vendor/scribe/css/theme-default.print.css") }}" media="print">

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
        var baseUrl = "http://localhost:8000";
        var useCsrf = Boolean(1);
        var csrfUrl = "/sanctum/csrf-cookie";
    </script>
    <script src="{{ asset("vendor/scribe/js/tryitout-3.26.0.js") }}"></script>

    <script src="{{ asset("vendor/scribe/js/theme-default-3.26.0.js") }}"></script>

</head>

<body data-languages="[&quot;bash&quot;,&quot;javascript&quot;,&quot;php&quot;]">

<a href="#" id="nav-button">
    <span>
        MENU
        <img src="{{ asset("vendor/scribe/images/navbar.png") }}" alt="navbar-image" />
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
                        <a href="#auth-endpoints-POSTregister">Handle a registration request for the application.</a>
                    </li>
                                    <li class="tocify-item level-2" data-unique="auth-endpoints-POSTlogin">
                        <a href="#auth-endpoints-POSTlogin">Handle a login request to the application.</a>
                    </li>
                                    <li class="tocify-item level-2" data-unique="auth-endpoints-GETprofile">
                        <a href="#auth-endpoints-GETprofile">Show authenticated user info</a>
                    </li>
                                                    </ul>
                            </ul>
                    <ul id="tocify-header-3" class="tocify-header">
                <li class="tocify-item level-1" data-unique="endpoints">
                    <a href="#endpoints">Endpoints</a>
                </li>
                                    <ul id="tocify-subheader-endpoints" class="tocify-subheader">
                                                    <li class="tocify-item level-2" data-unique="endpoints-GETsanctum-csrf-cookie">
                        <a href="#endpoints-GETsanctum-csrf-cookie">Return an empty response simply to trigger the storage of the CSRF cookie in the browser.</a>
                    </li>
                                    <li class="tocify-item level-2" data-unique="endpoints-POSTvoucher-create--count-">
                        <a href="#endpoints-POSTvoucher-create--count-">Store a newly created resource in storage.</a>
                    </li>
                                    <li class="tocify-item level-2" data-unique="endpoints-POSTredeem">
                        <a href="#endpoints-POSTredeem">Redeem and update the specified resource in storage.</a>
                    </li>
                                    <li class="tocify-item level-2" data-unique="endpoints-GET-user_id--extract">
                        <a href="#endpoints-GET-user_id--extract">Display a listing of the resource.</a>
                    </li>
                                    <li class="tocify-item level-2" data-unique="endpoints-GET-fallbackPlaceholder-">
                        <a href="#endpoints-GET-fallbackPlaceholder-">GET {fallbackPlaceholder}</a>
                    </li>
                                                    </ul>
                            </ul>
                    <ul id="tocify-header-4" class="tocify-header">
                <li class="tocify-item level-1" data-unique="incident-endpoints">
                    <a href="#incident-endpoints">Incident endpoints</a>
                </li>
                                    <ul id="tocify-subheader-incident-endpoints" class="tocify-subheader">
                                                    <li class="tocify-item level-2" data-unique="incident-endpoints-GETincidents">
                        <a href="#incident-endpoints-GETincidents">Display a listing of incidents that are active.</a>
                    </li>
                                    <li class="tocify-item level-2" data-unique="incident-endpoints-GET-user_id--incidents">
                        <a href="#incident-endpoints-GET-user_id--incidents">Display a listing of incidents by User.</a>
                    </li>
                                    <li class="tocify-item level-2" data-unique="incident-endpoints-POSTincident">
                        <a href="#incident-endpoints-POSTincident">Store a newly created resource in storage.</a>
                    </li>
                                    <li class="tocify-item level-2" data-unique="incident-endpoints-POSTincident--id--support">
                        <a href="#incident-endpoints-POSTincident--id--support">Support the incident.</a>
                    </li>
                                    <li class="tocify-item level-2" data-unique="incident-endpoints-POSTincident--id--refund">
                        <a href="#incident-endpoints-POSTincident--id--refund">Refund the incident</a>
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
        <li>Last updated: April 29 2022</li>
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
<pre><code class="language-yaml">http://localhost:8000</code></pre>

        <h1 id="authenticating-requests">Authenticating requests</h1>
<p>To authenticate requests, include an <strong><code>Authorization</code></strong> header with the value <strong><code>"Bearer {ACCESS_TOKEN}"</code></strong>.</p>
<p>All authenticated endpoints are marked with a <code>requires authentication</code> badge in the documentation below.</p>
<p>You can retrieve your token by  registering or logging in through <b>API endpoints</b>.</p>

        <h1 id="auth-endpoints">Auth endpoints</h1>

    

            <h2 id="auth-endpoints-POSTregister">Handle a registration request for the application.</h2>

<p>
</p>



<span id="example-requests-POSTregister">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://localhost:8000/register" \
    --header "Content-Type: application/json" \
    --data "{
    \"name\": \"Demo\",
    \"email\": \"demo@demo.com\",
    \"password\": \"password\"
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost:8000/register"
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
    'http://localhost:8000/register',
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
       &quot;email_verified_at&quot;: null,
       &quot;created_at&quot;: &quot;2022-04-25T06:21:47.000000Z&quot;,
       &quot;updated_at&quot;: &quot;2022-04-25T06:21:47.000000Z&quot;
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

            <h2 id="auth-endpoints-POSTlogin">Handle a login request to the application.</h2>

<p>
</p>



<span id="example-requests-POSTlogin">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://localhost:8000/login" \
    --header "Content-Type: application/json" \
    --data "{
    \"email\": \"demo@demo.com\",
    \"password\": \"password\"
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost:8000/login"
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
    'http://localhost:8000/login',
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
            <p>Example response (401):</p>
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
    &quot;error&quot;: &quot;Wrong credentials&quot;,
    &quot;code&quot;: 401
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
    --get "http://localhost:8000/profile" \
    --header "Authorization: Bearer {ACCESS_TOKEN}" \
    --header "Content-Type: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost:8000/profile"
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
    'http://localhost:8000/profile',
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

        <h1 id="endpoints">Endpoints</h1>

    

            <h2 id="endpoints-GETsanctum-csrf-cookie">Return an empty response simply to trigger the storage of the CSRF cookie in the browser.</h2>

<p>
</p>



<span id="example-requests-GETsanctum-csrf-cookie">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost:8000/sanctum/csrf-cookie" \
    --header "Content-Type: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost:8000/sanctum/csrf-cookie"
);

const headers = {
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
    'http://localhost:8000/sanctum/csrf-cookie',
    [
        'headers' =&gt; [
            'Content-Type' =&gt; 'application/json',
        ],
    ]
);
$body = $response-&gt;getBody();
print_r(json_decode((string) $body));</code></pre></div>

</span>

<span id="example-responses-GETsanctum-csrf-cookie">
            <blockquote>
            <p>Example response (204):</p>
        </blockquote>
                <details class="annotation">
            <summary>
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
access-control-allow-origin: *
set-cookie: XSRF-TOKEN=eyJpdiI6IjRjMkpuem8vV3Y5NW5OMnlUbVJRNGc9PSIsInZhbHVlIjoiL0syQjA4VWdWUW8vYnhzSDFNemo3Y1Q4UTNQYUtGR0xpeTlmMzZqS3dQbXRYeG1DSDF2cnJRbXNMQnVVeExlSjd5NmNmWXQvOXNZT3p1SjVTN1g4MEtadlcxN1dYWFJPTTZReWNjUzlrVnhZYWwzdW85aXZGd0ZCYTVIbFNOeEEiLCJtYWMiOiJlNDVhMDg2Y2QwMDNjY2MwMjk2NDY3MjgxZGE0MTE1NWY2NmQ4Zjc0MGQ2YmQ2NGQ4YjJlZWRjNTMyNDM3NGMxIiwidGFnIjoiIn0%3D; expires=Fri, 29-Apr-2022 06:30:27 GMT; Max-Age=7200; path=/; samesite=lax; laravel_session=eyJpdiI6IjBIeDIraHhjWmcyak9TbmtvcTI5WHc9PSIsInZhbHVlIjoicHNPTFZ2SFBJMmUrcmpQQ1duVUpINEpxOEEyOVlnU0Z5dnovRFRuRjJWVTZGTEZOSk1Na0xoV0lnOWxCWXFVVDdrd3NQQlEvM0JRY3lqVjMwL042SE9iUmpnWnRWMVIya2hLYVBsVy9iNjMwbFUwa1YrZ3VzcFU1dlArVWE0T1AiLCJtYWMiOiI4ODZkOTVlNGFmNjEzNjEwOGEzMmE5YzY2NjM0MDMwN2Y1MzVlZTAwYmQ1MTZjYjcwOTdjM2M0ZDZjMzU5ZjBiIiwidGFnIjoiIn0%3D; expires=Fri, 29-Apr-2022 06:30:27 GMT; Max-Age=7200; path=/; httponly; samesite=lax
 </code></pre>
        </details>         <pre>
<code>[Empty response]</code>
 </pre>
    </span>
<span id="execution-results-GETsanctum-csrf-cookie" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETsanctum-csrf-cookie"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETsanctum-csrf-cookie"></code></pre>
</span>
<span id="execution-error-GETsanctum-csrf-cookie" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETsanctum-csrf-cookie"></code></pre>
</span>
<form id="form-GETsanctum-csrf-cookie" data-method="GET"
      data-path="sanctum/csrf-cookie"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      data-headers='{"Content-Type":"application\/json"}'
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETsanctum-csrf-cookie', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETsanctum-csrf-cookie"
                    onclick="tryItOut('GETsanctum-csrf-cookie');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETsanctum-csrf-cookie"
                    onclick="cancelTryOut('GETsanctum-csrf-cookie');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETsanctum-csrf-cookie" hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>sanctum/csrf-cookie</code></b>
        </p>
                    </form>

            <h2 id="endpoints-POSTvoucher-create--count-">Store a newly created resource in storage.</h2>

<p>
</p>



<span id="example-requests-POSTvoucher-create--count-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://localhost:8000/voucher/create/delectus" \
    --header "Content-Type: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost:8000/voucher/create/delectus"
);

const headers = {
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
    'http://localhost:8000/voucher/create/delectus',
    [
        'headers' =&gt; [
            'Content-Type' =&gt; 'application/json',
        ],
    ]
);
$body = $response-&gt;getBody();
print_r(json_decode((string) $body));</code></pre></div>

</span>

<span id="example-responses-POSTvoucher-create--count-">
            <blockquote>
            <p>Example response (302):</p>
        </blockquote>
                <details class="annotation">
            <summary>
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
location: http://localhost:8000/login
content-type: text/html; charset=UTF-8
access-control-allow-origin: *
 </code></pre>
        </details>         <pre>

<code class="language-json">&lt;!DOCTYPE html&gt;
&lt;html&gt;
    &lt;head&gt;
        &lt;meta charset=&quot;UTF-8&quot; /&gt;
        &lt;meta http-equiv=&quot;refresh&quot; content=&quot;0;url='http://localhost:8000/login'&quot; /&gt;

        &lt;title&gt;Redirecting to http://localhost:8000/login&lt;/title&gt;
    &lt;/head&gt;
    &lt;body&gt;
        Redirecting to &lt;a href=&quot;http://localhost:8000/login&quot;&gt;http://localhost:8000/login&lt;/a&gt;.
    &lt;/body&gt;
&lt;/html&gt;</code>
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
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      data-headers='{"Content-Type":"application\/json"}'
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
                    <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <p>
                <b><code>count</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
                <input type="text"
               name="count"
               data-endpoint="POSTvoucher-create--count-"
               value="delectus"
               data-component="url" hidden>
    <br>

            </p>
                    </form>

            <h2 id="endpoints-POSTredeem">Redeem and update the specified resource in storage.</h2>

<p>
</p>



<span id="example-requests-POSTredeem">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://localhost:8000/redeem" \
    --header "Content-Type: application/json" \
    --data "{
    \"token\": \"BW9JREEVNH181H54ISMK\",
    \"user_id\": 2
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost:8000/redeem"
);

const headers = {
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
    'http://localhost:8000/redeem',
    [
        'headers' =&gt; [
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

<span id="example-responses-POSTredeem">
            <blockquote>
            <p>Example response (302):</p>
        </blockquote>
                <details class="annotation">
            <summary>
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
location: http://localhost:8000/login
content-type: text/html; charset=UTF-8
access-control-allow-origin: *
 </code></pre>
        </details>         <pre>

<code class="language-json">&lt;!DOCTYPE html&gt;
&lt;html&gt;
    &lt;head&gt;
        &lt;meta charset=&quot;UTF-8&quot; /&gt;
        &lt;meta http-equiv=&quot;refresh&quot; content=&quot;0;url='http://localhost:8000/login'&quot; /&gt;

        &lt;title&gt;Redirecting to http://localhost:8000/login&lt;/title&gt;
    &lt;/head&gt;
    &lt;body&gt;
        Redirecting to &lt;a href=&quot;http://localhost:8000/login&quot;&gt;http://localhost:8000/login&lt;/a&gt;.
    &lt;/body&gt;
&lt;/html&gt;</code>
 </pre>
    </span>
<span id="execution-results-POSTredeem" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTredeem"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTredeem"></code></pre>
</span>
<span id="execution-error-POSTredeem" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTredeem"></code></pre>
</span>
<form id="form-POSTredeem" data-method="POST"
      data-path="redeem"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      data-headers='{"Content-Type":"application\/json"}'
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTredeem', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTredeem"
                    onclick="tryItOut('POSTredeem');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTredeem"
                    onclick="cancelTryOut('POSTredeem');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTredeem" hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>redeem</code></b>
        </p>
                            <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <p>
            <b><code>token</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
                <input type="text"
               name="token"
               data-endpoint="POSTredeem"
               value="BW9JREEVNH181H54ISMK"
               data-component="body" hidden>
    <br>
<p>The token with 20 characters to be redeem.</p>
        </p>
                <p>
            <b><code>user_id</code></b>&nbsp;&nbsp;<small>integer</small>  &nbsp;
                <input type="number"
               name="user_id"
               data-endpoint="POSTredeem"
               value="2"
               data-component="body" hidden>
    <br>
<p>The id of the user.</p>
        </p>
        </form>

            <h2 id="endpoints-GET-user_id--extract">Display a listing of the resource.</h2>

<p>
</p>



<span id="example-requests-GET-user_id--extract">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost:8000/omnis/extract" \
    --header "Content-Type: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost:8000/omnis/extract"
);

const headers = {
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
    'http://localhost:8000/omnis/extract',
    [
        'headers' =&gt; [
            'Content-Type' =&gt; 'application/json',
        ],
    ]
);
$body = $response-&gt;getBody();
print_r(json_decode((string) $body));</code></pre></div>

</span>

<span id="example-responses-GET-user_id--extract">
            <blockquote>
            <p>Example response (302):</p>
        </blockquote>
                <details class="annotation">
            <summary>
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
location: http://localhost:8000/login
content-type: text/html; charset=UTF-8
access-control-allow-origin: *
 </code></pre>
        </details>         <pre>

<code class="language-json">&lt;!DOCTYPE html&gt;
&lt;html&gt;
    &lt;head&gt;
        &lt;meta charset=&quot;UTF-8&quot; /&gt;
        &lt;meta http-equiv=&quot;refresh&quot; content=&quot;0;url='http://localhost:8000/login'&quot; /&gt;

        &lt;title&gt;Redirecting to http://localhost:8000/login&lt;/title&gt;
    &lt;/head&gt;
    &lt;body&gt;
        Redirecting to &lt;a href=&quot;http://localhost:8000/login&quot;&gt;http://localhost:8000/login&lt;/a&gt;.
    &lt;/body&gt;
&lt;/html&gt;</code>
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
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      data-headers='{"Content-Type":"application\/json"}'
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
                    <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <p>
                <b><code>user_id</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
                <input type="text"
               name="user_id"
               data-endpoint="GET-user_id--extract"
               value="omnis"
               data-component="url" hidden>
    <br>
<p>The ID of the user.</p>
            </p>
                    </form>

            <h2 id="endpoints-GET-fallbackPlaceholder-">GET {fallbackPlaceholder}</h2>

<p>
</p>



<span id="example-requests-GET-fallbackPlaceholder-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost:8000/ll)l6" \
    --header "Content-Type: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost:8000/ll)l6"
);

const headers = {
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
    'http://localhost:8000/ll)l6',
    [
        'headers' =&gt; [
            'Content-Type' =&gt; 'application/json',
        ],
    ]
);
$body = $response-&gt;getBody();
print_r(json_decode((string) $body));</code></pre></div>

</span>

<span id="example-responses-GET-fallbackPlaceholder-">
            <blockquote>
            <p>Example response (404):</p>
        </blockquote>
                <details class="annotation">
            <summary>
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
x-ratelimit-limit: 60
x-ratelimit-remaining: 58
access-control-allow-origin: *
 </code></pre>
        </details>         <pre>

<code class="language-json">{
    &quot;message&quot;: &quot;Not found&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-GET-fallbackPlaceholder-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GET-fallbackPlaceholder-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GET-fallbackPlaceholder-"></code></pre>
</span>
<span id="execution-error-GET-fallbackPlaceholder-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GET-fallbackPlaceholder-"></code></pre>
</span>
<form id="form-GET-fallbackPlaceholder-" data-method="GET"
      data-path="{fallbackPlaceholder}"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      data-headers='{"Content-Type":"application\/json"}'
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GET-fallbackPlaceholder-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GET-fallbackPlaceholder-"
                    onclick="tryItOut('GET-fallbackPlaceholder-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GET-fallbackPlaceholder-"
                    onclick="cancelTryOut('GET-fallbackPlaceholder-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GET-fallbackPlaceholder-" hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>{fallbackPlaceholder}</code></b>
        </p>
                    <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <p>
                <b><code>fallbackPlaceholder</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
                <input type="text"
               name="fallbackPlaceholder"
               data-endpoint="GET-fallbackPlaceholder-"
               value="ll)l6"
               data-component="url" hidden>
    <br>

            </p>
                    </form>

        <h1 id="incident-endpoints">Incident endpoints</h1>

    

            <h2 id="incident-endpoints-GETincidents">Display a listing of incidents that are active.</h2>

<p>
</p>



<span id="example-requests-GETincidents">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost:8000/incidents" \
    --header "Content-Type: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost:8000/incidents"
);

const headers = {
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
    'http://localhost:8000/incidents',
    [
        'headers' =&gt; [
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
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      data-headers='{"Content-Type":"application\/json"}'
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
                    </form>

            <h2 id="incident-endpoints-GET-user_id--incidents">Display a listing of incidents by User.</h2>

<p>
</p>



<span id="example-requests-GET-user_id--incidents">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost:8000/in/incidents?user_id=quas" \
    --header "Content-Type: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost:8000/in/incidents"
);

const params = {
    "user_id": "quas",
};
Object.keys(params)
    .forEach(key =&gt; url.searchParams.append(key, params[key]));

const headers = {
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
    'http://localhost:8000/in/incidents',
    [
        'headers' =&gt; [
            'Content-Type' =&gt; 'application/json',
        ],
        'query' =&gt; [
            'user_id'=&gt; 'quas',
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
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      data-headers='{"Content-Type":"application\/json"}'
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
                    <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <p>
                <b><code>user_id</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
                <input type="text"
               name="user_id"
               data-endpoint="GET-user_id--incidents"
               value="in"
               data-component="url" hidden>
    <br>
<p>The ID of the user.</p>
            </p>
                        <h4 class="fancy-heading-panel"><b>Query Parameters</b></h4>
                    <p>
                <b><code>user_id</code></b>&nbsp;&nbsp;<small>string</small>     <i>optional</i> &nbsp;
                <input type="text"
               name="user_id"
               data-endpoint="GET-user_id--incidents"
               value="quas"
               data-component="query" hidden>
    <br>
<p>To filter the incidents by specific user_id</p>
            </p>
                </form>

            <h2 id="incident-endpoints-POSTincident">Store a newly created resource in storage.</h2>

<p>
</p>



<span id="example-requests-POSTincident">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://localhost:8000/incident" \
    --header "Content-Type: application/json" \
    --data "{
    \"title\": \"Need help\",
    \"description\": \"Need help for something..\",
    \"user_id\": 2
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost:8000/incident"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "title": "Need help",
    "description": "Need help for something..",
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
    'http://localhost:8000/incident',
    [
        'headers' =&gt; [
            'Content-Type' =&gt; 'application/json',
        ],
        'json' =&gt; [
            'title' =&gt; 'Need help',
            'description' =&gt; 'Need help for something..',
            'user_id' =&gt; 2,
        ],
    ]
);
$body = $response-&gt;getBody();
print_r(json_decode((string) $body));</code></pre></div>

</span>

<span id="example-responses-POSTincident">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <pre>

<code class="language-json">{
    &quot;data&quot;: {
        &quot;title&quot;: &quot;Help my Cats&quot;,
        &quot;description&quot;: &quot;Need help to feed my cats please&quot;,
        &quot;owner&quot;: &quot;CatFan&quot;,
        &quot;total_raised&quot;: 0,
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
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      data-headers='{"Content-Type":"application\/json"}'
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
            <b><code>user_id</code></b>&nbsp;&nbsp;<small>integer</small>  &nbsp;
                <input type="number"
               name="user_id"
               data-endpoint="POSTincident"
               value="2"
               data-component="body" hidden>
    <br>
<p>The id of the user trying to create the incident.</p>
        </p>
        </form>

            <h2 id="incident-endpoints-POSTincident--id--support">Support the incident.</h2>

<p>
</p>



<span id="example-requests-POSTincident--id--support">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://localhost:8000/incident/8/support" \
    --header "Content-Type: application/json" \
    --data "{
    \"user_id\": 2,
    \"value\": 40
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost:8000/incident/8/support"
);

const headers = {
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
    'http://localhost:8000/incident/8/support',
    [
        'headers' =&gt; [
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
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      data-headers='{"Content-Type":"application\/json"}'
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
                    <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <p>
                <b><code>id</code></b>&nbsp;&nbsp;<small>integer</small>  &nbsp;
                <input type="number"
               name="id"
               data-endpoint="POSTincident--id--support"
               value="8"
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
</p>



<span id="example-requests-POSTincident--id--refund">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://localhost:8000/incident/5/refund" \
    --header "Content-Type: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost:8000/incident/5/refund"
);

const headers = {
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
    'http://localhost:8000/incident/5/refund',
    [
        'headers' =&gt; [
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
            <p>Example response (404, Incident does not exist):</p>
        </blockquote>
                <pre>

<code class="language-json">{
   &quot;Incident does not exist&quot;
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
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      data-headers='{"Content-Type":"application\/json"}'
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
                    <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <p>
                <b><code>id</code></b>&nbsp;&nbsp;<small>integer</small>  &nbsp;
                <input type="number"
               name="id"
               data-endpoint="POSTincident--id--refund"
               value="5"
               data-component="url" hidden>
    <br>
<p>The ID of the incident.</p>
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
