
protected function graphql(
  string $query, array $variables = [], array $data = [], array $headers = []
): TestResponse {
  $data = [
    'query' => $query,
    'variables' => \json_encode($variables)
  ] + $data;
  return $this->post('/graphql', $data, $headers);
}

