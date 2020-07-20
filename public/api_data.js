define({ "api": [
  {
    "type": "post",
    "url": "/cities",
    "title": "Add a city",
    "examples": [
      {
        "title": "Example usage:",
        "content": "curl -d \"Name=Тест&eng_Name=temp\" -X POST http://api.stuhelp.site/cities",
        "type": "curl"
      }
    ],
    "version": "0.1.0",
    "name": "AddCity",
    "group": "City",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "Name",
            "description": "<p>Russian name of the city</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "eng_Name",
            "description": "<p>(optional)English name of the city</p>"
          }
        ]
      }
    },
    "success": {
      "examples": [
        {
          "title": "Success-Response:",
          "content": "HTTP/1.1 200 OK\n{\n  \"message\":\"Done. New id: 1\"\n}",
          "type": "json"
        }
      ]
    },
    "error": {
      "examples": [
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 404 Not Found\n{\n  \"message\": \"Name is empty\"\n}",
          "type": "json"
        }
      ]
    },
    "filename": "./api/Api_Cities.php",
    "groupTitle": "City"
  },
  {
    "type": "delete",
    "url": "/cities",
    "title": "Delete a city",
    "examples": [
      {
        "title": "Example usage with id:",
        "content": "curl -d \"id=1\" -X DELETE http://api.stuhelp.site/cities",
        "type": "curl"
      },
      {
        "title": "Example usage with name:",
        "content": "curl -d \"name=Тест\" -X DELETE http://api.stuhelp.site/cities",
        "type": "curl"
      }
    ],
    "version": "0.1.0",
    "name": "DeleteCity",
    "group": "City",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>Id of the city</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "Name",
            "description": "<p>Russian name of the city</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "eng_Name",
            "description": "<p>English name of the city</p>"
          }
        ]
      }
    },
    "success": {
      "examples": [
        {
          "title": "Success-Response:",
          "content": "HTTP/1.1 200 OK\n{\n  \"message\":\"Done\"\n}",
          "type": "json"
        }
      ]
    },
    "error": {
      "examples": [
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 404 Not Found\n{\n  \"message\": \"Data is empty\"\n}",
          "type": "json"
        }
      ]
    },
    "filename": "./api/Api_Cities.php",
    "groupTitle": "City"
  },
  {
    "type": "get",
    "url": "/cities",
    "title": "Request all cities",
    "version": "0.1.0",
    "name": "GetCities",
    "group": "City",
    "success": {
      "examples": [
        {
          "title": "Success-Response:",
          "content": "HTTP/1.1 200 OK\n[\n   {\n     \"id\":\"3\",\n     \"Name\":\"Николаев\",\n     \"eng_Name\":\"Mykolaiv\"\n   },\n   {\n     \"id\":\"4\",\n     \"Name\":\"Киев\",\n     \"eng_Name\":\"Kiev\"\n   }\n]",
          "type": "json"
        }
      ]
    },
    "error": {
      "examples": [
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 404 Not Found\n{\n  \"message\": \"City was not found\"\n}",
          "type": "json"
        }
      ]
    },
    "filename": "./api/Api_Cities.php",
    "groupTitle": "City"
  },
  {
    "type": "get",
    "url": "/cities/:id",
    "title": "Request the city",
    "version": "0.1.0",
    "name": "GetCity",
    "group": "City",
    "examples": [
      {
        "title": "Example usage with id:",
        "content": "http://api.stuhelp.site/cities/12",
        "type": "curl"
      },
      {
        "title": "Example usage with name:",
        "content": "http://api.stuhelp.site/cities?Name=Тест",
        "type": "curl"
      },
      {
        "title": "Example usage with name:",
        "content": "http://api.stuhelp.site/cities?eng_Name=temp",
        "type": "curl"
      }
    ],
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>City unique ID.</p>"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>Id of the city.</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "Name",
            "description": "<p>Russian name of the city.</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "eng_Name",
            "description": "<p>English name of the city.</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Success-Response:",
          "content": "HTTP/1.1 200 OK\n{\n  \"id\":\"4\",\n  \"Name\":\"Киев\",\n  \"eng_Name\":\"Kiev\"\n}",
          "type": "json"
        }
      ]
    },
    "error": {
      "examples": [
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 404 Not Found\n{\n  \"message\": \"City was not found\"\n}",
          "type": "json"
        }
      ]
    },
    "filename": "./api/Api_Cities.php",
    "groupTitle": "City"
  },
  {
    "type": "post",
    "url": "/cities",
    "title": "Update information of the city",
    "examples": [
      {
        "title": "It changes info by the first value(id) Example changing eng_Name:",
        "content": "curl -d \"id=10&eng_Name=temp\" -X PUT http://api.stuhelp.site/cities",
        "type": "curl"
      },
      {
        "title": "Example changing Name:",
        "content": "curl -d \"id=10&Name=Тест\" -X PUT http://api.stuhelp.site/cities",
        "type": "curl"
      }
    ],
    "version": "0.1.0",
    "name": "UpdateCity",
    "group": "City",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "Name",
            "description": "<p>Russian name of the city</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "eng_Name",
            "description": "<p>(optional)English name of the city</p>"
          }
        ]
      }
    },
    "success": {
      "examples": [
        {
          "title": "Success-Response:",
          "content": "HTTP/1.1 200 OK\n{\n  \"message\":\"Done\"\n}",
          "type": "json"
        }
      ]
    },
    "error": {
      "examples": [
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 404 Not Found\n{\n  \"message\": \"Data is empty\"\n}",
          "type": "json"
        }
      ]
    },
    "filename": "./api/Api_Cities.php",
    "groupTitle": "City"
  },
  {
    "type": "post",
    "url": "/countries",
    "title": "Add a country",
    "examples": [
      {
        "title": "Example usage:",
        "content": "curl -d \"Name=Тест&eng_Name=temp\" -X POST http://api.stuhelp.site/countries",
        "type": "curl"
      }
    ],
    "version": "0.1.0",
    "name": "AddCountry",
    "group": "Country",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "Name",
            "description": "<p>Russian name of the country</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "eng_Name",
            "description": "<p>(optional)English name of the country</p>"
          }
        ]
      }
    },
    "success": {
      "examples": [
        {
          "title": "Success-Response:",
          "content": "HTTP/1.1 200 OK\n{\n  \"message\":\"Done. New id: 1\"\n}",
          "type": "json"
        }
      ]
    },
    "error": {
      "examples": [
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 404 Not Found\n{\n  \"message\": \"Name is empty\"\n}",
          "type": "json"
        }
      ]
    },
    "filename": "./api/Api_Countries.php",
    "groupTitle": "Country"
  },
  {
    "type": "delete",
    "url": "/countries",
    "title": "Delete a country",
    "examples": [
      {
        "title": "Example usage with id:",
        "content": "curl -d \"id=1\" -X DELETE http://api.stuhelp.site/countries",
        "type": "curl"
      },
      {
        "title": "Example usage with name:",
        "content": "curl -d \"name=Тест\" -X DELETE http://api.stuhelp.site/countries",
        "type": "curl"
      }
    ],
    "version": "0.1.0",
    "name": "DeleteCountry",
    "group": "Country",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>Id of the country</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "Name",
            "description": "<p>Russian name of the country</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "eng_Name",
            "description": "<p>English name of the country</p>"
          }
        ]
      }
    },
    "success": {
      "examples": [
        {
          "title": "Success-Response:",
          "content": "HTTP/1.1 200 OK\n{\n  \"message\":\"Done\"\n}",
          "type": "json"
        }
      ]
    },
    "error": {
      "examples": [
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 404 Not Found\n{\n  \"message\": \"Data is empty\"\n}",
          "type": "json"
        }
      ]
    },
    "filename": "./api/Api_Countries.php",
    "groupTitle": "Country"
  },
  {
    "type": "get",
    "url": "/countries",
    "title": "Request all countries",
    "version": "0.1.0",
    "name": "GetCountries",
    "group": "Country",
    "success": {
      "examples": [
        {
          "title": "Success-Response:",
          "content": "HTTP/1.1 200 OK\n[\n   {\n     \"id\":\"3\",\n     \"Name\":\"Украина\",\n     \"eng_Name\":\"Ukraine\"\n   },\n   {\n     \"id\":\"4\",\n     \"Name\":\"Польша\",\n     \"eng_Name\":\"Poland\"\n   }\n]",
          "type": "json"
        }
      ]
    },
    "error": {
      "examples": [
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 404 Not Found\n{\n  \"message\": \"Country was not found\"\n}",
          "type": "json"
        }
      ]
    },
    "filename": "./api/Api_Countries.php",
    "groupTitle": "Country"
  },
  {
    "type": "get",
    "url": "/countries/:id",
    "title": "Request the country",
    "version": "0.1.0",
    "name": "GetCountry",
    "group": "Country",
    "examples": [
      {
        "title": "Example usage with id:",
        "content": "http://api.stuhelp.site/countries/12",
        "type": "curl"
      },
      {
        "title": "Example usage with name:",
        "content": "http://api.stuhelp.site/countries?Name=Тест",
        "type": "curl"
      },
      {
        "title": "Example usage with english name:",
        "content": "http://api.stuhelp.site/countries?eng_Name=temp",
        "type": "curl"
      }
    ],
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>Country unique ID.</p>"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>Id of the country.</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "Name",
            "description": "<p>Russian name of the country.</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "eng_Name",
            "description": "<p>English name of the country.</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Success-Response:",
          "content": "HTTP/1.1 200 OK\n{\n  \"id\":\"5\",\n  \"Name\":\"Россия\",\n  \"eng_Name\":\"Russia\"\n}",
          "type": "json"
        }
      ]
    },
    "error": {
      "examples": [
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 404 Not Found\n{\n  \"message\": \"Country was not found\"\n}",
          "type": "json"
        }
      ]
    },
    "filename": "./api/Api_Countries.php",
    "groupTitle": "Country"
  },
  {
    "type": "post",
    "url": "/countries",
    "title": "Update information of the country",
    "examples": [
      {
        "title": "It changes info by the first value(id) Example changing eng_Name:",
        "content": "curl -d \"id=10&eng_Name=temp\" -X PUT http://api.stuhelp.site/countries",
        "type": "curl"
      },
      {
        "title": "Example changing Name:",
        "content": "curl -d \"id=10&Name=Тест\" -X PUT http://api.stuhelp.site/countries",
        "type": "curl"
      }
    ],
    "version": "0.1.0",
    "name": "UpdateCountry",
    "group": "Country",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "Name",
            "description": "<p>Russian name of the country</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "eng_Name",
            "description": "<p>(optional)English name of the country</p>"
          }
        ]
      }
    },
    "success": {
      "examples": [
        {
          "title": "Success-Response:",
          "content": "HTTP/1.1 200 OK\n{\n  \"message\":\"Done\"\n}",
          "type": "json"
        }
      ]
    },
    "error": {
      "examples": [
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 404 Not Found\n{\n  \"message\": \"Data is empty\"\n}",
          "type": "json"
        }
      ]
    },
    "filename": "./api/Api_Countries.php",
    "groupTitle": "Country"
  },
  {
    "type": "post",
    "url": "/discipline",
    "title": "Add a discipline",
    "examples": [
      {
        "title": "Example usage:",
        "content": "curl -d \"Name=Тест\" -X POST http://api.stuhelp.site/discipline",
        "type": "curl"
      }
    ],
    "version": "0.1.0",
    "name": "AddDiscipline",
    "group": "Discipline",
    "success": {
      "examples": [
        {
          "title": "Success-Response:",
          "content": "HTTP/1.1 200 OK\n{\n  \"message\":\"Done. New id: 1\"\n}",
          "type": "json"
        }
      ]
    },
    "error": {
      "examples": [
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 404 Not Found\n{\n  \"message\": \"Name is empty\"\n}",
          "type": "json"
        }
      ]
    },
    "filename": "./api/Api_Discipline.php",
    "groupTitle": "Discipline"
  },
  {
    "type": "delete",
    "url": "/discipline",
    "title": "Delete a discipline",
    "examples": [
      {
        "title": "Example usage with id:",
        "content": "curl -d \"id=1\" -X DELETE http://api.stuhelp.site/discipline",
        "type": "curl"
      },
      {
        "title": "Example usage with name:",
        "content": "curl -d \"Name=Тест\" -X DELETE http://api.stuhelp.site/discipline",
        "type": "curl"
      }
    ],
    "version": "0.1.0",
    "name": "DeleteDiscipline",
    "group": "Discipline",
    "success": {
      "examples": [
        {
          "title": "Success-Response:",
          "content": "HTTP/1.1 200 OK\n{\n  \"message\":\"Done\"\n}",
          "type": "json"
        }
      ]
    },
    "error": {
      "examples": [
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 404 Not Found\n{\n  \"message\": \"Data is empty\"\n}",
          "type": "json"
        }
      ]
    },
    "filename": "./api/Api_Discipline.php",
    "groupTitle": "Discipline"
  },
  {
    "type": "get",
    "url": "/discipline/:id",
    "title": "Request the discipline",
    "version": "0.1.0",
    "name": "GetDiscipline",
    "group": "Discipline",
    "examples": [
      {
        "title": "Example usage with id:",
        "content": "http://api.stuhelp.site/discipline/12",
        "type": "curl"
      },
      {
        "title": "Example usage with name:",
        "content": "http://api.stuhelp.site/discipline?Name=Тест",
        "type": "curl"
      }
    ],
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>Discipline's unique ID.</p>"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>Id of the discipline.</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "Name",
            "description": "<p>Name of the discipline.</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Success-Response:",
          "content": "HTTP/1.1 200 OK\n{\n  \"id\":\"4\",\n  \"Name\":\"Биология\",\n}",
          "type": "json"
        }
      ]
    },
    "error": {
      "examples": [
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 404 Not Found\n{\n  \"message\": \"Discipline was not found\"\n}",
          "type": "json"
        }
      ]
    },
    "filename": "./api/Api_Discipline.php",
    "groupTitle": "Discipline"
  },
  {
    "type": "get",
    "url": "/discipline",
    "title": "Request all disciplines",
    "version": "0.1.0",
    "name": "GetDisciplines",
    "group": "Discipline",
    "success": {
      "examples": [
        {
          "title": "Success-Response:",
          "content": "HTTP/1.1 200 OK\n[\n   {\n     \"id\":\"3\",\n     \"Name\":\"Математика\",\n   },\n   {\n     \"id\":\"4\",\n     \"Name\":\"Биология\",\n   }\n]",
          "type": "json"
        }
      ]
    },
    "error": {
      "examples": [
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 404 Not Found\n{\n  \"message\": \"Discipline was not found\"\n}",
          "type": "json"
        }
      ]
    },
    "filename": "./api/Api_Discipline.php",
    "groupTitle": "Discipline"
  },
  {
    "type": "post",
    "url": "/discipline",
    "title": "Update information of the discipline",
    "examples": [
      {
        "title": "Example changing Name:",
        "content": "curl -d \"id=10&Name=Тест\" -X PUT http://api.stuhelp.site/discipline",
        "type": "curl"
      }
    ],
    "version": "0.1.0",
    "name": "UpdateDiscipline",
    "group": "Discipline",
    "success": {
      "examples": [
        {
          "title": "Success-Response:",
          "content": "HTTP/1.1 200 OK\n{\n  \"message\":\"Done\"\n}",
          "type": "json"
        }
      ]
    },
    "error": {
      "examples": [
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 404 Not Found\n{\n  \"message\": \"Data is empty\"\n}",
          "type": "json"
        }
      ]
    },
    "filename": "./api/Api_Discipline.php",
    "groupTitle": "Discipline"
  },
  {
    "type": "post",
    "url": "/event",
    "title": "Add a event",
    "examples": [
      {
        "title": "Example usage:",
        "content": "curl -d \"EvWhen=2001-05-08 18:30:30&id_User=10&EvType=1&EvWhere=Кинотеатр Юность&Keywords=День рождения,праздник&WhenDoHW=2001-05-10\" -X POST http://api.stuhelp.site/event",
        "type": "curl"
      }
    ],
    "version": "0.1.0",
    "name": "AddEvent",
    "group": "Event",
    "success": {
      "examples": [
        {
          "title": "Success-Response:",
          "content": "HTTP/1.1 200 OK\n{\n  \"message\":\"Done. New id: 1\"\n}",
          "type": "json"
        }
      ]
    },
    "error": {
      "examples": [
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 404 Not Found\n{\n  \"message\": \"EvWhen or id_User is empty\"\n}",
          "type": "json"
        }
      ]
    },
    "filename": "./api/Api_AboutEvent.php",
    "groupTitle": "Event"
  },
  {
    "type": "delete",
    "url": "/event",
    "title": "Delete an event",
    "examples": [
      {
        "title": "Example usage with time of hw:",
        "content": "curl -d \"WhenDoHW=2002-05-10\" -X DELETE http://api.stuhelp.site/event",
        "type": "curl"
      }
    ],
    "version": "0.1.0",
    "name": "DeleteEvent",
    "group": "Event",
    "success": {
      "examples": [
        {
          "title": "Success-Response:",
          "content": "HTTP/1.1 200 OK\n{\n  \"message\":\"Done\"\n}",
          "type": "json"
        }
      ]
    },
    "error": {
      "examples": [
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 404 Not Found\n{\n  \"message\": \"Data is empty\"\n}",
          "type": "json"
        }
      ]
    },
    "filename": "./api/Api_AboutEvent.php",
    "groupTitle": "Event"
  },
  {
    "type": "get",
    "url": "/event/:id",
    "title": "Request the event",
    "version": "0.1.0",
    "name": "GetEvent",
    "group": "Event",
    "examples": [
      {
        "title": "Example usage with id:",
        "content": "http://api.stuhelp.site/event/12",
        "type": "url"
      },
      {
        "title": "Example usage with id of the user:",
        "content": "http://api.stuhelp.site/event?id_User=10",
        "type": "url"
      },
      {
        "title": "Example usage by time of the event:",
        "content": "http://api.stuhelp.site/event?EvWhen=2020-07-12 18:00:00",
        "type": "url"
      }
    ],
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>Event unique ID.</p>"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>Id of the event.</p>"
          },
          {
            "group": "Success 200",
            "type": "Datetime",
            "optional": false,
            "field": "EvWhen",
            "description": "<p>Time of the event. YYYY-MM-DD HH:MM:SS</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "id_User",
            "description": "<p>Id of owner.</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "EvType",
            "description": "<p>Type of the event.0 = usual, 1 = class in the university( def = 0 )</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "EvWhere",
            "description": "<p>Place of the event( class, street ).</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "id_Subject",
            "description": "<p>(university)</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "id_Theme",
            "description": "<p>(university)</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "Keywords",
            "description": "<p>(university)</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "Questions",
            "description": "<p>(university)</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "Homework",
            "description": "<p>(university)</p>"
          },
          {
            "group": "Success 200",
            "type": "Datetime",
            "optional": false,
            "field": "WhenDoHW",
            "description": "<p>(university) When you will do homework</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Success-Response:",
          "content": "HTTP/1.1 200 OK\n{\n \"id\":\"1\",\n \"EvWhen\":\"2020-07-12 18:00:00\",\n \"id_User\":\"10\",\n \"EvType\":\"1\",\n \"EvWhere\":\"Кинотеатр Юность\",\n \"id_Subject\":null,\n \"id_Theme\":null,\n \"Keywords\":\"День рождения,праздник\",\n \"Questions\":null,\n \"Homework\":null,\n \"WhenDoHW\":\"2001-05-10 00:00:00\"\n}",
          "type": "json"
        }
      ]
    },
    "error": {
      "examples": [
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 404 Not Found\n{\n  \"message\": \"Event was not found\"\n}",
          "type": "json"
        }
      ]
    },
    "filename": "./api/Api_AboutEvent.php",
    "groupTitle": "Event"
  },
  {
    "type": "get",
    "url": "/event",
    "title": "Request all events",
    "version": "0.1.0",
    "name": "GetEvents",
    "group": "Event",
    "success": {
      "examples": [
        {
          "title": "Success-Response:",
          "content": "HTTP/1.1 200 OK\n[\n  {\n   \"id\":\"1\",\n   \"EvWhen\":\"2020-07-12 18:00:00\",\n   \"id_User\":\"10\",\n   \"EvType\":\"1\",\n   \"EvWhere\":\"Кинотеатр Юность\",\n   \"id_Subject\":null,\n   \"id_Theme\":null,\n   \"Keywords\":\"День рождения,праздник\",\n   \"Questions\":null,\n   \"Homework\":null,\n   \"WhenDoHW\":\"2001-05-10 00:00:00\"\n  }\n]",
          "type": "json"
        }
      ]
    },
    "error": {
      "examples": [
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 404 Not Found\n{\n  \"message\": \"Event was not found\"\n}",
          "type": "json"
        }
      ]
    },
    "filename": "./api/Api_AboutEvent.php",
    "groupTitle": "Event"
  },
  {
    "type": "post",
    "url": "/countries",
    "title": "Update information of the event",
    "examples": [
      {
        "title": "It changes info by the first value(id) Example changing time of the event:",
        "content": "curl -d \"id=1&EvWhen=2020-07-12 18:00:00\" -X PUT http://api.stuhelp.site/event",
        "type": "curl"
      }
    ],
    "version": "0.1.0",
    "name": "UpdateEvent",
    "group": "Event",
    "success": {
      "examples": [
        {
          "title": "Success-Response:",
          "content": "HTTP/1.1 200 OK\n{\n  \"message\":\"Done\"\n}",
          "type": "json"
        }
      ]
    },
    "error": {
      "examples": [
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 404 Not Found\n{\n  \"message\": \"Data is empty\"\n}",
          "type": "json"
        }
      ]
    },
    "filename": "./api/Api_AboutEvent.php",
    "groupTitle": "Event"
  },
  {
    "type": "post",
    "url": "/group",
    "title": "Add a group",
    "examples": [
      {
        "title": "Example usage:",
        "content": "curl -d \"Name=Тест171\" -X POST http://api.stuhelp.site/group",
        "type": "curl"
      }
    ],
    "version": "0.1.0",
    "name": "AddGroup",
    "group": "Group",
    "success": {
      "examples": [
        {
          "title": "Success-Response:",
          "content": "HTTP/1.1 200 OK\n{\n  \"message\":\"Done. New id: 1\"\n}",
          "type": "json"
        }
      ]
    },
    "error": {
      "examples": [
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 404 Not Found\n{\n  \"message\": \"Name is empty\"\n}",
          "type": "json"
        }
      ]
    },
    "filename": "./api/Api_Group.php",
    "groupTitle": "Group"
  },
  {
    "type": "delete",
    "url": "/group",
    "title": "Delete a group",
    "examples": [
      {
        "title": "Example usage with id:",
        "content": "curl -d \"id=1\" -X DELETE http://api.stuhelp.site/group",
        "type": "curl"
      },
      {
        "title": "Example usage with name:",
        "content": "curl -d \"Name=Тест\" -X DELETE http://api.stuhelp.site/group",
        "type": "curl"
      }
    ],
    "version": "0.1.0",
    "name": "DeleteGroup",
    "group": "Group",
    "success": {
      "examples": [
        {
          "title": "Success-Response:",
          "content": "HTTP/1.1 200 OK\n{\n  \"message\":\"Done\"\n}",
          "type": "json"
        }
      ]
    },
    "error": {
      "examples": [
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 404 Not Found\n{\n  \"message\": \"Data is empty\"\n}",
          "type": "json"
        }
      ]
    },
    "filename": "./api/Api_Group.php",
    "groupTitle": "Group"
  },
  {
    "type": "get",
    "url": "/group/:id",
    "title": "Request the group",
    "version": "0.1.0",
    "name": "GetGroup",
    "group": "Group",
    "examples": [
      {
        "title": "Example usage with id:",
        "content": "http://api.stuhelp.site/group/12",
        "type": "curl"
      },
      {
        "title": "Example usage with the university:",
        "content": "http://api.stuhelp.site/group?University=Тест",
        "type": "curl"
      }
    ],
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>Group's unique ID.</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "Name",
            "description": "<p>Group's name.</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "University",
            "description": "<p>Name of the group's university</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "id_ElderStudent",
            "description": "<p>Id of the group's manager</p>"
          }
        ]
      }
    },
    "success": {
      "examples": [
        {
          "title": "Success-Response:",
          "content": "HTTP/1.1 200 OK\n{\n  \"id\":\"4\",\n  \"Name\":\"171\",\n  \"University\":\"Mohula\",\n  \"id_ElderStudent\":\"7\"\n}",
          "type": "json"
        }
      ]
    },
    "error": {
      "examples": [
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 404 Not Found\n{\n  \"message\": \"Group was not found\"\n}",
          "type": "json"
        }
      ]
    },
    "filename": "./api/Api_Group.php",
    "groupTitle": "Group"
  },
  {
    "type": "get",
    "url": "/group",
    "title": "Request all groups",
    "version": "0.1.0",
    "name": "GetGroups",
    "group": "Group",
    "success": {
      "examples": [
        {
          "title": "Success-Response:",
          "content": "HTTP/1.1 200 OK\n[\n   {\n     \"id\":\"3\",\n     \"Name\":\"Математика\",\n   },\n   {\n     \"id\":\"4\",\n     \"Name\":\"Биология\",\n   }\n]",
          "type": "json"
        }
      ]
    },
    "error": {
      "examples": [
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 404 Not Found\n{\n  \"message\": \"Group was not found\"\n}",
          "type": "json"
        }
      ]
    },
    "filename": "./api/Api_Group.php",
    "groupTitle": "Group"
  },
  {
    "type": "post",
    "url": "/group",
    "title": "Update information of the group",
    "examples": [
      {
        "title": "Example changing Name:",
        "content": "curl -d \"id=10&Name=Тест\" -X PUT http://api.stuhelp.site/group",
        "type": "curl"
      }
    ],
    "version": "0.1.0",
    "name": "UpdateGroup",
    "group": "Group",
    "success": {
      "examples": [
        {
          "title": "Success-Response:",
          "content": "HTTP/1.1 200 OK\n{\n  \"message\":\"Done\"\n}",
          "type": "json"
        }
      ]
    },
    "error": {
      "examples": [
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 404 Not Found\n{\n  \"message\": \"Data is empty\"\n}",
          "type": "json"
        }
      ]
    },
    "filename": "./api/Api_Group.php",
    "groupTitle": "Group"
  },
  {
    "type": "post",
    "url": "/subject",
    "title": "Add a subject",
    "examples": [
      {
        "title": "Example usage:",
        "content": "curl -d \"Name=Тест&id_Discipline=5\" -X POST http://api.stuhelp.site/subject",
        "type": "curl"
      }
    ],
    "version": "0.1.0",
    "name": "AddSubject",
    "group": "Subject",
    "success": {
      "examples": [
        {
          "title": "Success-Response:",
          "content": "HTTP/1.1 200 OK\n{\n  \"message\":\"Done. New id: 1\"\n}",
          "type": "json"
        }
      ]
    },
    "error": {
      "examples": [
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 404 Not Found\n{\n  \"message\": \"Name is empty\"\n}",
          "type": "json"
        }
      ]
    },
    "filename": "./api/Api_Subject.php",
    "groupTitle": "Subject"
  },
  {
    "type": "delete",
    "url": "/subject",
    "title": "Delete a subject",
    "examples": [
      {
        "title": "Example usage with id:",
        "content": "curl -d \"id=1\" -X DELETE http://api.stuhelp.site/subject",
        "type": "curl"
      },
      {
        "title": "Example usage with name:",
        "content": "curl -d \"name=Тест\" -X DELETE http://api.stuhelp.site/subject",
        "type": "curl"
      }
    ],
    "version": "0.1.0",
    "name": "DeleteSubject",
    "group": "Subject",
    "success": {
      "examples": [
        {
          "title": "Success-Response:",
          "content": "HTTP/1.1 200 OK\n{\n  \"message\":\"Done\"\n}",
          "type": "json"
        }
      ]
    },
    "error": {
      "examples": [
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 404 Not Found\n{\n  \"message\": \"Data is empty\"\n}",
          "type": "json"
        }
      ]
    },
    "filename": "./api/Api_Subject.php",
    "groupTitle": "Subject"
  },
  {
    "type": "get",
    "url": "/subject/:id",
    "title": "Request the subject",
    "version": "0.1.0",
    "name": "GetSubject",
    "group": "Subject",
    "examples": [
      {
        "title": "Example usage with id:",
        "content": "http://api.stuhelp.site/subject/12",
        "type": "curl"
      },
      {
        "title": "Example usage with name:",
        "content": "http://api.stuhelp.site/subject?Name=Тест",
        "type": "curl"
      }
    ],
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>Id of the subject.</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "Name",
            "description": "<p>Russian name of the subject.</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "id_Discipline",
            "description": "<p>Id of the subject's discipline</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Success-Response:",
          "content": "HTTP/1.1 200 OK\n{\n  \"id\":\"4\",\n  \"Name\":\"Теор мех\",\n  \"id_Discipline\":\"5\"\n}",
          "type": "json"
        }
      ]
    },
    "error": {
      "examples": [
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 404 Not Found\n{\n  \"message\": \"Subject was not found\"\n}",
          "type": "json"
        }
      ]
    },
    "filename": "./api/Api_Subject.php",
    "groupTitle": "Subject"
  },
  {
    "type": "get",
    "url": "/subject",
    "title": "Request all subjects",
    "version": "0.1.0",
    "name": "GetSubjects",
    "group": "Subject",
    "success": {
      "examples": [
        {
          "title": "Success-Response:",
          "content": "HTTP/1.1 200 OK\n[\n   {\n     \"id\":\"3\",\n     \"Name\":\"Выш мат\",\n     \"id_Discipline\":\"4\"\n   },\n   {\n     \"id\":\"4\",\n     \"Name\":\"Теор мех\",\n     \"id_Discipline\":\"5\"\n   }\n]",
          "type": "json"
        }
      ]
    },
    "error": {
      "examples": [
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 404 Not Found\n{\n  \"message\": \"Subject was not found\"\n}",
          "type": "json"
        }
      ]
    },
    "filename": "./api/Api_Subject.php",
    "groupTitle": "Subject"
  },
  {
    "type": "post",
    "url": "/subject",
    "title": "Update information of the subject",
    "examples": [
      {
        "title": "Example changing Name:",
        "content": "curl -d \"id=10&Name=Тест\" -X PUT http://api.stuhelp.site/subject",
        "type": "curl"
      }
    ],
    "version": "0.1.0",
    "name": "UpdateSubject",
    "group": "Subject",
    "success": {
      "examples": [
        {
          "title": "Success-Response:",
          "content": "HTTP/1.1 200 OK\n{\n  \"message\":\"Done\"\n}",
          "type": "json"
        }
      ]
    },
    "error": {
      "examples": [
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 404 Not Found\n{\n  \"message\": \"Data is empty\"\n}",
          "type": "json"
        }
      ]
    },
    "filename": "./api/Api_Subject.php",
    "groupTitle": "Subject"
  },
  {
    "type": "post",
    "url": "/theme",
    "title": "Add a theme",
    "examples": [
      {
        "title": "Example usage:",
        "content": "curl -d \"Name=Тест&id_Subject=5\" -X POST http://api.stuhelp.site/theme",
        "type": "curl"
      }
    ],
    "version": "0.1.0",
    "name": "AddTheme",
    "group": "Theme",
    "success": {
      "examples": [
        {
          "title": "Success-Response:",
          "content": "HTTP/1.1 200 OK\n{\n  \"message\":\"Done. New id: 1\"\n}",
          "type": "json"
        }
      ]
    },
    "error": {
      "examples": [
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 404 Not Found\n{\n  \"message\": \"Name is empty\"\n}",
          "type": "json"
        }
      ]
    },
    "filename": "./api/Api_Theme.php",
    "groupTitle": "Theme"
  },
  {
    "type": "delete",
    "url": "/theme",
    "title": "Delete a theme",
    "examples": [
      {
        "title": "Example usage with id:",
        "content": "curl -d \"id=1\" -X DELETE http://api.stuhelp.site/theme",
        "type": "curl"
      },
      {
        "title": "Example usage with name:",
        "content": "curl -d \"name=Тест\" -X DELETE http://api.stuhelp.site/theme",
        "type": "curl"
      }
    ],
    "version": "0.1.0",
    "name": "DeleteTheme",
    "group": "Theme",
    "success": {
      "examples": [
        {
          "title": "Success-Response:",
          "content": "HTTP/1.1 200 OK\n{\n  \"message\":\"Done\"\n}",
          "type": "json"
        }
      ]
    },
    "error": {
      "examples": [
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 404 Not Found\n{\n  \"message\": \"Data is empty\"\n}",
          "type": "json"
        }
      ]
    },
    "filename": "./api/Api_Theme.php",
    "groupTitle": "Theme"
  },
  {
    "type": "get",
    "url": "/theme/:id",
    "title": "Request the theme",
    "version": "0.1.0",
    "name": "GetTheme",
    "group": "Theme",
    "examples": [
      {
        "title": "Example usage with id:",
        "content": "http://api.stuhelp.site/theme/12",
        "type": "curl"
      },
      {
        "title": "Example usage with name:",
        "content": "http://api.stuhelp.site/theme?Name=Тест",
        "type": "curl"
      }
    ],
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>Id of the theme.</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "Name",
            "description": "<p>Name of the theme.</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "id_Subject",
            "description": "<p>Id of the theme's subject</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "id_User",
            "description": "<p>Id of the theme's owner</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Success-Response:",
          "content": "HTTP/1.1 200 OK\n{\n     \"id\":\"4\",\n     \"Name\":\"Фермы\",\n     \"id_Subject\":\"5\",\n     \"id_User\":\"5\"\n}",
          "type": "json"
        }
      ]
    },
    "error": {
      "examples": [
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 404 Not Found\n{\n  \"message\": \"Theme was not found\"\n}",
          "type": "json"
        }
      ]
    },
    "filename": "./api/Api_Theme.php",
    "groupTitle": "Theme"
  },
  {
    "type": "get",
    "url": "/theme",
    "title": "Request all themes",
    "version": "0.1.0",
    "name": "GetThemes",
    "group": "Theme",
    "success": {
      "examples": [
        {
          "title": "Success-Response:",
          "content": "HTTP/1.1 200 OK\n[\n   {\n     \"id\":\"3\",\n     \"Name\":\"Производная\",\n     \"id_Subject\":\"4\",\n     \"id_User\":\"5\"\n   },\n   {\n     \"id\":\"4\",\n     \"Name\":\"Фермы\",\n     \"id_Subject\":\"5\",\n     \"id_User\":\"5\"\n   }\n]",
          "type": "json"
        }
      ]
    },
    "error": {
      "examples": [
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 404 Not Found\n{\n  \"message\": \"Theme was not found\"\n}",
          "type": "json"
        }
      ]
    },
    "filename": "./api/Api_Theme.php",
    "groupTitle": "Theme"
  },
  {
    "type": "post",
    "url": "/theme",
    "title": "Update information of the theme",
    "examples": [
      {
        "title": "Example changing Name:",
        "content": "curl -d \"id=10&Name=Тест\" -X PUT http://api.stuhelp.site/theme",
        "type": "curl"
      }
    ],
    "version": "0.1.0",
    "name": "UpdateTheme",
    "group": "Theme",
    "success": {
      "examples": [
        {
          "title": "Success-Response:",
          "content": "HTTP/1.1 200 OK\n{\n  \"message\":\"Done\"\n}",
          "type": "json"
        }
      ]
    },
    "error": {
      "examples": [
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 404 Not Found\n{\n  \"message\": \"Data is empty\"\n}",
          "type": "json"
        }
      ]
    },
    "filename": "./api/Api_Theme.php",
    "groupTitle": "Theme"
  },
  {
    "type": "post",
    "url": "/user",
    "title": "Add a user",
    "examples": [
      {
        "title": "Example usage:",
        "content": "curl -d \"Name=Вася&Surname=Фканер&Login=azf&Email=111@111&PassHash=222&PassSalt=111&Coins=10&LastLogin=2020-05-05 16\" -X POST http://api.stuhelp.site/user",
        "type": "curl"
      }
    ],
    "version": "0.1.0",
    "name": "AddUser",
    "group": "User",
    "success": {
      "examples": [
        {
          "title": "Success-Response:",
          "content": "HTTP/1.1 200 OK\n{\n  \"message\":\"Done. New id: 1\"\n}",
          "type": "json"
        }
      ]
    },
    "error": {
      "examples": [
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 404 Not Found\n{\n  \"message\": \"EvWhen or id_User is empty\"\n}",
          "type": "json"
        }
      ]
    },
    "filename": "./api/Api_User.php",
    "groupTitle": "User"
  },
  {
    "type": "delete",
    "url": "/user",
    "title": "Delete a user",
    "examples": [
      {
        "title": "Example with id:",
        "content": "curl -d \"id=1\" -X DELETE http://api.stuhelp.site/user",
        "type": "curl"
      }
    ],
    "version": "0.1.0",
    "name": "DeleteUser",
    "group": "User",
    "success": {
      "examples": [
        {
          "title": "Success-Response:",
          "content": "HTTP/1.1 200 OK\n{\n  \"message\":\"Done\"\n}",
          "type": "json"
        }
      ]
    },
    "error": {
      "examples": [
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 404 Not Found\n{\n  \"message\": \"Data is empty\"\n}",
          "type": "json"
        }
      ]
    },
    "filename": "./api/Api_User.php",
    "groupTitle": "User"
  },
  {
    "type": "get",
    "url": "/user/:id",
    "title": "Request a user",
    "version": "0.1.0",
    "name": "GetUser",
    "group": "User",
    "examples": [
      {
        "title": "Example usage with id:",
        "content": "http://api.stuhelp.site/user/12",
        "type": "url"
      },
      {
        "title": "Example usage with name of the user:",
        "content": "http://api.stuhelp.site/user?Name=Вася",
        "type": "url"
      }
    ],
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>User's unique ID.</p>"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>Id of a user.</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "Name",
            "description": "<p>User's name</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "Surname",
            "description": "<p>User's surname</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "Login",
            "description": "<p>User's login</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "Email",
            "description": "<p>User's email</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "PassHash",
            "description": "<p>User's hash</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "PassSalt",
            "description": "<p>User's salt for hash</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "Coins",
            "description": "<p>User's coins( for shop )</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "id_Group",
            "description": "<p>Id of user's group</p>"
          },
          {
            "group": "Success 200",
            "type": "DateTime",
            "optional": false,
            "field": "LastLogin",
            "description": "<p>The last time a user logged in to the site</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "id_Interface",
            "description": "<p>Id of the current interface</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "ShopInfo",
            "description": "<p>Which interfaces a user have bought</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "id_City",
            "description": "<p>City of a user</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "id_Country",
            "description": "<p>Id of the country of a user</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Success-Response:",
          "content": "HTTP/1.1 200 OK\n{\n \"id\":\"1\",\n \"Name\":\"Вася\",\n \"Surname\":\"Фканер\",\n \"Login\":\"azf\",\n \"Email\":\"111@111\",\n \"PassHash\":\"222\",\n \"PassSalt\":\"111\",\n \"Coins\":\"10\",\n \"id_Group\":null,\n \"LastLogin\":\"2020-05-05 16:00:00\",\n \"id_Interface\":null,\n \"ShopInfo\":null,\n \"id_City\":null,\n \"id_Country\":null\n}",
          "type": "json"
        }
      ]
    },
    "error": {
      "examples": [
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 404 Not Found\n{\n  \"message\": \"User was not found\"\n}",
          "type": "json"
        }
      ]
    },
    "filename": "./api/Api_User.php",
    "groupTitle": "User"
  },
  {
    "type": "get",
    "url": "/user",
    "title": "Request all users",
    "version": "0.1.0",
    "name": "GetUsers",
    "group": "User",
    "success": {
      "examples": [
        {
          "title": "Success-Response:",
          "content": "HTTP/1.1 200 OK\n[\n  {\n   \"id\":\"1\",\n   \"Name\":\"Вася\",\n   \"Surname\":\"Фканер\",\n   \"Login\":\"azf\",\n   \"Email\":\"111@111\",\n   \"PassHash\":\"222\",\n   \"PassSalt\":\"111\",\n   \"Coins\":\"10\",\n   \"id_Group\":null,\n   \"LastLogin\":\"2020-05-05 16:00:00\",\n   \"id_Interface\":null,\n   \"ShopInfo\":null,\n   \"id_City\":null,\n   \"id_Country\":null\n  }\n]",
          "type": "json"
        }
      ]
    },
    "error": {
      "examples": [
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 404 Not Found\n{\n  \"message\": \"User was not found\"\n}",
          "type": "json"
        }
      ]
    },
    "filename": "./api/Api_User.php",
    "groupTitle": "User"
  },
  {
    "type": "post",
    "url": "/user",
    "title": "Update information of the user",
    "examples": [
      {
        "title": "Example changing time of the user's name:",
        "content": "curl -d \"id=1&Name=Вася\" -X PUT http://api.stuhelp.site/user",
        "type": "curl"
      }
    ],
    "version": "0.1.0",
    "name": "UpdateUser",
    "group": "User",
    "success": {
      "examples": [
        {
          "title": "Success-Response:",
          "content": "HTTP/1.1 200 OK\n{\n  \"message\":\"Done\"\n}",
          "type": "json"
        }
      ]
    },
    "error": {
      "examples": [
        {
          "title": "Error-Response:",
          "content": "HTTP/1.1 404 Not Found\n{\n  \"message\": \"Data is empty\"\n}",
          "type": "json"
        }
      ]
    },
    "filename": "./api/Api_User.php",
    "groupTitle": "User"
  }
] });
