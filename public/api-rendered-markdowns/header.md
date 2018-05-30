## **Usage Overview**

Here are some information that should help you understand the basic usage of our RESTful API. 
Including info about authenticating users, making requests, responses, potential errors, rate limiting, pagination, query parameters and more.

## **Headers**

Certain API calls require you to send data in a particular format as part of the API call. 
By default, all API calls expect input in `JSON` format, however you need to inform the server that you are sending a JSON-formatted payload.
And to do that you must include the `Accept => application/json` HTTP header with every call.


| Header        | Value Sample                        | When to send it                                                              |
|---------------|-------------------------------------|------------------------------------------------------------------------------|
| Accept        | `application/json`                  | MUST be sent with every endpoint.                                            |
| Content-Type  | `application/x-www-form-urlencoded` | MUST be sent when passing Data.                                              |
| Authorization | `Bearer {Access-Token-Here}`        | MUST be sent whenever the endpoint requires (Authenticated User).            |

## **Rate limiting**

All REST API requests are throttled to prevent abuse and ensure stability. 
The exact number of calls that your application can make per day varies based on the type of request you are making.

The rate limit window is `1` minutes per endpoint, with most individual calls allowing for `30` requests in each window.

*In other words, each user is allowed to make `30` calls per endpoint every `1` minutes. (For each unique access token).*

For how many hits you can preform on an endpoint, you can always check the header:

```
X-RateLimit-Limit → 30
X-RateLimit-Remaining → 29
```

## **Tokens**

The Access Token lives for `1 days, 0 hours, 0 minutes and 0 seconds`. (equivalent to `1440` minutes).
While the Refresh Token lives for `30 days, 0 hours, 0 minutes and 0 seconds`. (equivalent to `43200` minutes).

*You will need to re-authenticate the user when the token expires.*

## **Responses**

Unless otherwise specified, all of API endpoints will return the information that you request in the JSON data format.


#### Standard Response Format

```shell
{
    "status": "ok",
    "data": {
        "token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOi8vYXBpLnlveW9naS5vby9hcGkvYXV0aC9sb2dpbiIsImlhdCI6MTUyNzY1OTU4NiwiZXhwIjoxNTI3NjYzMTg2LCJuYmYiOjE1Mjc2NTk1ODYsImp0aSI6IldFQW02WFhzS0lReUFSS20iLCJzdWIiOjEsInBydiI6Ijg3ZTBhZjFlZjlmZDE1ODEyZmRlYzk3MTUzYTE0ZTBiMDQ3NTQ2YWEifQ.Q9X4MQ-b0AZ8Nd1aPe4tLXXvCy4NYuubM_lgkcl5aC4",
        "expires_in": 3600
    }
}
```

#### Header

Header Response:

```
Content-Type → application/json
Date → Thu, 14 Feb 2014 22:33:55 GMT
ETag → "9c83bf4cf0d09c34782572727281b85879dd4ff6"
Server → nginx
Transfer-Encoding → chunked
X-Powered-By → PHP/7.0.9
X-RateLimit-Limit → 100
X-RateLimit-Remaining → 99
```

## **Errors** (Outdated)

General Errors:

| Error Code | Message                                                                               | Reason                                              |
|------------|---------------------------------------------------------------------------------------|-----------------------------------------------------|
| 401        | Wrong number of segments.                                                             | Wrong Token.                                        |
| 401        | Failed to authenticate because of bad credentials or an invalid authorization header. | Missing parts of the Token.                         |
| 401        | Could not decode token: The token ... is an invalid JWS.                              | Missing Token.                                      |
| 405        | Method Not Allowed.                                                                   | Wrong Endpoint URL.                                 |
| 422        | Invalid Input.                                                                        | Validation Error.                                   |
| 500        | Internal Server Error.                                                                | {Report this error as soon as you get it.}          |
| 500        | This action is unauthorized.                                                          | Using wrong HTTP Verb. OR using unauthorized token. |

TO BE CONTINUE...

