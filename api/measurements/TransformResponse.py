class TransformResponse:
    def handle(self, application, response):
        content = response.content if response.status_code == 200 \
            else {"error": response.text}

        return application.response_class(
            response=content,
            status=response.status_code,
            mimetype='application/json'
        )
