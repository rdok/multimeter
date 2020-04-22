import json


class Transform:
    def handle(self, application, response):

        try:
            json.loads(response.content)
            content = response.content
        except ValueError as error:
            content = {"error": response.text}

        return application.response_class(
            response=content,
            status=response.status_code,
            mimetype='application/json'
        )
