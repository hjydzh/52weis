<?php

namespace common;

class JianSql {
	
	public static $BLOG_SELECT = "SELECT J.ID, J.TITLE, J.AUTHOR_NAME, J.TIME, J.SELECTED_TIME,J.SHOW_TIME, J.VIEW_NUM, J.LAST_VIEW_NUM FROM HOT_BLOG AS J";
	
	public static $VIEW_SELECT = "SELECT V.BLOG_ID, V.VIEWS, V.AUTHOR_URL, CREATE_TIME, UPDATE_TIME FROM BLOG_VIEW AS V";
	
	public static $QUERY_HOT_BLOGS= " WHERE date(`SELECTED_TIME`)=? order by last_view_num desc limit ? ";
	
	public static $QUERY_BLOGS_NUMS = "SELECT COUNT(1) FROM HOT_BLOG where date(`SELECTED_TIME`)=?";
	
	public static $QUERY_BLOGS_NUMS_DATE = "SELECT COUNT(1) FROM HOT_BLOG where ?<=`SELECTED_TIME` AND `SELECTED_TIME`<=? ";
	
	public static $QUERY_SHOW_TIME = "SELECT MIN(SHOW_TIME),AVG(SHOW_TIME),MAX(SHOW_TIME) FROM  hot_blog  where date(`SELECTED_TIME`)=?";

	public static $QUERY_READ_RATE = "SELECT AVG(VIEW_NUM*3600/TIMESTAMPDIFF(SECOND ,`TIME`,`SELECTED_TIME`)), AVG((LAST_VIEW_NUM-VIEW_NUM)*3600/SHOW_TIME) FROM  hot_blog where date(`SELECTED_TIME`)=?";
	
	public static $QUERY_VIEWS_BY_URL = "select views from blog_view where blog_id=?";
	
	public static $QUERY_VIEWS_BY_TIME = "where ?<=`UPDATE_TIME` AND `UPDATE_TIME`<=? ";
}

 

?>