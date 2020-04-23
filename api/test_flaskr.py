import pytest


def test_temperatures_are_querable(client):

    response = client.get('/api/temperatures/')

    assert {'bla': 'cyberpunk'} == response.data
