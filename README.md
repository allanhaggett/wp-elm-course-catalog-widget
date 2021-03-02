# PeopleSoft ELM Wordpress Course Catalog Search Widget
A widget that displays a search box that returns matching courses 
that are contained within The PSA Learning system

The Learning Centre has built a temporary bridge between the 
courses that are contained within the Public Service Agency's 
instance of PeopleSoft ELM (PSA Learning System). A manual admin
process produces a JSON Feed at a public URL, updated on a weekly
schedule. This widget embeds that feed into the widget and 
provides a javascript interface to search through the available 
courses and access them on the PSA Learning System.

At this stage, the widget currently reads directly from public URL
for the JSON feed on every page load:

https://learn.bcpublicservice.gov.bc.ca/learningcentre/courses/feed.json

At our scale, this shouldn't really matter too much, but it might 
be a better plan in the long run to upload the JSON file directly
into wordpress where it runs so it's only loading the file locally.

It's probably that this is only a short-term 1-3 years solution, 
so take it in that context; I'm trying to patch together systems
here as we transition away from ELM.
