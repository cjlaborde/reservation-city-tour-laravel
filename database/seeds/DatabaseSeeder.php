<?php
/*
|--------------------------------------------------------------------------
| database/seeds/DatabaseSeeder.php *** Copyright netprogs.pl | available only at Udemy.com | further distribution is prohibited  ***
|--------------------------------------------------------------------------
*/

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UsersTableSeeder::class); /* Part 10 */
        $this->call(CitiesTableSeeder::class);   /* Part 10 */      
        $this->call(ObjectsTableSeeder::class); /* Part 10 */
        $this->call(AddressesTableSeeder::class); /* Part 10 */
        $this->call(NotificationsTableSeeder::class); /* Part 10 */
        $this->call(ArticlesTableSeeder::class); /* Part 10 */
        $this->call(CommentsTableSeeder::class); /* Part 10 */
        $this->call(LikeablesTableSeeder::class); /* Part 11 */
        $this->call(PhotosTableSeeder::class); /* Part 11 */
        $this->call(RoomsTableSeeder::class); /* Part 11 */
        $this->call(ReservationsTableSeeder::class); /* Part 11 */
        $this->call(RolesTableSeeder::class); /* Part 11 */
        $this->call(RoleUserTableSeeder::class); /* Part 11 */

    }
}
