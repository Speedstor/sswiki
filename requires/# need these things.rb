# need these things

# a topic will have 
    [rateHistory, general, deepDive, tutorial, tips, fun, toolbox] 

    // compiled_related_topics

topic_rateHistory
    -   id
        user
        rating_id
        if_positive
        date
        significance

topic_editHistory
    -   id
        edit_increment
        whatId
        from
        to

topic_editPending
    -   id
        whatId
        from
        to
        approvalStatus


topic_general
topic_deepDive
    -   id
        title
        whatId
        edit_increment
        main_link
        picture_link
        sitemap_json -> (rating_id)
        is_book
        compiled_rating
        positive_rating
        negative_rating
        rating_id



topic_tutorial
    ->  order
topic_tips
topic_fun
topic_toolbox
    ->  id
        title
        edit_increment
        whatId
        link
        compiled_rating
        positive_rating
        negative_rating
        rating_id



---------------------------------------------------------------------



all_rateHistory
    -> original_score
    -   id
        user
        rating_id
        whatId
        if_positive
        date
        actionType
        originality      (creator, first-edit, second-edit)
        significance
        anonymous


all_rating
    -   id
        whatId
        title
        last_edit
        compiled_rating    DEFAULT
        positive_rating    DEFAULT
        negative_rating    DEFAULT
        clicked            DEFAULT
        seen_times         DEFAULT 


all_topics
    -   id
        topicname
        topic_title
        last_edit
        popularity
        description


~ branches
# table "topics"




CREATE TABLE `all_rating` (
  `id` int NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `whatId` tinytext NOT NULL,
  `title` tinytext NOT NULL,
  `last_edit` datetime NOT NULL,
  `compiled_rating` tinyint NOT NULL DEFAULT '10',
  `positive_rating` int NOT NULL DEFAULT '0',
  `negative_rating` int NOT NULL DEFAULT '0',
  `clicked` int NOT NULL DEFAULT '0',
  `seen_times` int NOT NULL DEFAULT '0'
) AUTO_INCREMENT=1;