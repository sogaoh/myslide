
curl -X POST \
--user $(USER_ID):$(APP_PASSWORD) \
--header 'Content-type: application/json' \
'https://api.bitbucket.org/2.0/repositories/$(YOUR_ORG)/$(YOUR_REPO)/pipelines_config/schedules/' \
--data '{"type":"pipeline_schedule","enabled":true,
  "target": {"type":"pipeline_ref_target","ref_type":"branch","ref_name":"develop",
  "selector":{"type":"custom","pattern":"$(JOB_NAME)"}},
  "cron_pattern": "0 15 0 ? * MON,TUE,WED,THU,FRI *"
}'
