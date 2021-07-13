<?php get_header(); ?>
<?php $cur_user_id = get_current_user_id();
echo "Hello $current_user->user_login ! You’re logged in as "; echo get_user_role( $cur_user_id ) ?>
<?php get_footer(); ?>
</body>
</html>