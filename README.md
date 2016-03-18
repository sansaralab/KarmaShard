# KarmaShard

[![Build Status](https://travis-ci.org/sansaralab/KarmaShard.svg?branch=master)](https://travis-ci.org/sansaralab/KarmaShard)
[![SensioLabsInsight](https://insight.sensiolabs.com/projects/fe7ba5b1-d032-4110-8509-10d4c66808af/mini.png)](https://insight.sensiolabs.com/projects/fe7ba5b1-d032-4110-8509-10d4c66808af)
[![Code Climate](https://codeclimate.com/github/sansaralab/KarmaShard/badges/gpa.svg)](https://codeclimate.com/github/sansaralab/KarmaShard)


KarmaShard is tool for collecting and analyze user actions.

## About idea

Users making some actions at your site/application. Every action has could be positive, negative or neutral. Actions has a various weight of theis positive and negative. This is stored in categories.

All actions belongs to some category. Category has name and weight. Negative weight - negative category and same with positive and neutral.

Sample categories:

* Buying premium item (weight: +7)
* Deceiving the courier (weight: -10)

Main function of KarmaShard is calculating abstract person's 'karma'.

## About karma

Karma is, in primitive, sum of weight of all actions. And can be used for making decision about client care.
