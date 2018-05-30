define({ "api": [
  {
    "group": "Authentication",
    "name": "RegisterUser",
    "type": "post",
    "url": "/api/auth/register",
    "title": "Register User",
    "description": "<p>Register a new artist or patron</p>",
    "version": "1.0.0",
    "permission": [
      {
        "name": "none"
      }
    ],
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "name",
            "description": "<p>the complete name of the user</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "email",
            "description": "<p>unique email of the user</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "password",
            "description": "<p>at least 6 characters</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "role",
            "description": "<p>artist | patron</p>"
          }
        ]
      }
    },
    "success": {
      "examples": [
        {
          "title": "Success-Response:",
          "content": "{ \"status\": \"ok\"}",
          "type": "json"
        }
      ]
    },
    "filename": "app/Api/V1/Authentication/Controllers/RegisterController.php",
    "groupTitle": "Authentication"
  },
  {
    "group": "Authentication",
    "name": "loginUser",
    "type": "post",
    "url": "/api/auth/login",
    "title": "Login User (Email)",
    "description": "<p>Logging in users via api endpoint.</p>",
    "version": "1.0.0",
    "permission": [
      {
        "name": "none"
      }
    ],
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "email",
            "description": "<p>unique email of the user</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "password",
            "description": "<p>at least 6 characters</p>"
          }
        ]
      }
    },
    "success": {
      "examples": [
        {
          "title": "Success-Response:",
          "content": "                    {\n\"status\": \"ok\",\n\"data\": {\n\"token\":\n\"eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOi8vYXBpLnlveW9naS5vby9hcGkvYXV0aC9sb2dpbiIsImlhdCI6MTUyNzY1NjY5MywiZXhwIjoxNTI3NjYwMjkzLCJuYmYiOjE1Mjc2NTY2OTMsImp0aSI6IkZuRzM4b3E1djBncGtCVVQiLCJzdWIiOjEsInBydiI6Ijg3ZTBhZjFlZjlmZDE1ODEyZmRlYzk3MTUzYTE0ZTBiMDQ3NTQ2YWEifQ.2FTKzqpfH-XPT_FfBUt2RE7PPgXUMDGIcMgInzHwNnI\",\n\"expires_in\": 3600\n}\n}",
          "type": "json"
        }
      ]
    },
    "error": {
      "examples": [
        {
          "title": "Error-Response:",
          "content": "                {\n\"status\": \"error\",\n\"data\": {\n\"message\": \"403 Forbidden\",\n\"status_code\": 403\n}\n}",
          "type": "json"
        }
      ]
    },
    "filename": "app/Api/V1/Authentication/Controllers/LoginController.php",
    "groupTitle": "Authentication"
  }
] });
