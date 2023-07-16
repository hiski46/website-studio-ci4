<?php

namespace App\Database\Seeds;

/**
 * @package CodeIgniter-Ion-Auth
 */

class IonAuthSeeder extends \CodeIgniter\Database\Seeder
{
	/**
	 * Dumping data for table 'groups', 'users, 'users_groups'
	 *
	 * @return void
	 */
	public function run()
	{
		$config = config('IonAuth\\Config\\IonAuth');
		$this->DBGroup = empty($config->databaseGroupName) ? '' : $config->databaseGroupName;
		$tables        = $config->tables;
		$this->db->transStart();
		$groups = [
			[
				'name'        => 'admin',
				'description' => 'Administrator',
			],
			[
				'name'        => 'members',
				'description' => 'General User',
			]
		];
		$this->db->table($tables['groups'])->insertBatch($groups);

		$img = [
			[
				'small' 	=> 'default.png',
				'medium' 	=> 'default.png',
				'large' 	=> 'default.png',
			]
		];
		$this->db->table('image')->insertBatch($img);

		$users = [
			[
				'ip_address'              => '127.0.0.1',
				'username'                => 'administrator',
				'password'                => '$2y$08$200Z6ZZbp3RAEXoaWcMA6uJOFicwNZaqk4oDhqTUiFXFe63MG.Daa',
				'email'                   => 'admin@admin.com',
				'activation_code'         => '',
				'forgotten_password_code' => null,
				'created_on'              => '1268889823',
				'last_login'              => '1268889823',
				'active'                  => '1',
				'first_name'              => 'Admin',
				'last_name'               => 'istrator',
				'company'                 => 'ADMIN',
				'phone'                   => '0',
				'img' => 1
			]
		];
		$this->db->table($tables['users'])->insertBatch($users);

		$usersGroups = [
			[
				'user_id'  => '1',
				'group_id' => '1',
			],
			[
				'user_id'  => '1',
				'group_id' => '2',
			]
		];
		$this->db->table($tables['users_groups'])->insertBatch($usersGroups);

		$shopCategory = [
			[
				'category'  => 'Family',
			],
			[
				'category'  => 'Wisuda',
			],
			[
				'category'  => 'Baby and Matrnity',
			],
			[
				'category'  => 'Corporate',
			],
			[
				'category'  => 'Prewedding',
			],
			[
				'category'  => 'Bridal',
			],
			[
				'category'  => 'Foto Personal',
			],
			[
				'category'  => 'Make Up',
			],
		];
		$this->db->table('paket_category')->insertBatch($shopCategory);

		$biodata = [
			[
				'biodata' => 'tentang',
				'value' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. A id nam eius corporis impedit repellendus enim, vero doloribus magnam ab quos vel laudantium necessitatibus cupiditate voluptates, earum dicta consequatur recusandae deserunt voluptate officiis praesentium nemo, eveniet obcaecati. Tempora nihil natus veritatis facilis culpa, ipsum quis illo dolorem, quia facere numquam et saepe deserunt veniam ipsam repellat suscipit labore consequuntur, at earum voluptas omnis? Debitis, itaque! Illum rerum consequuntur asperiores dolorem ducimus at modi assumenda quod! Facilis dolores quaerat vitae, deleniti et corrupti, molestias veritatis ab beatae quidem earum a ipsum impedit labore libero harum aliquid fuga animi? Dicta, ipsam delectus?'
			],
			[
				'biodata' => 'sejarah',
				'value'	=> "Lorem ipsum dolor sit, amet consectetur adipisicing elit. Et distinctio id quod ducimus doloribus. Vel illo, sequi veritatis id, repellendus a earum dignissimos ex tenetur nulla saepe doloremque laborum consequatur, quam pariatur laboriosam quod totam aliquid natus esse culpa adipisci."
			],
			[
				'biodata' => 'logo',
				'value'	=> 'logo.png',
			],
			[
				'biodata' => 'phone',
				'value'	=> '0808 6666 2222',
			],
			[
				'biodata' => 'email',
				'value'	=> 'studio@mail.com',
			],
			[
				'biodata' => 'no_rek',
				'value'	=> '12891278812',
			],
			[
				'biodata' => 'instagram',
				'value'	=> 'instagram.com/studio'
			],
			[
				'biodata' => 'facebook',
				'value'	=> 'instagram.com/studio'
			],
			[
				'biodata' => 'alamat',
				'value'	=> 'Jln. saja no. 11'
			]
		];
		$this->db->table('biodata')->insertBatch($biodata);

		$this->db->transComplete();
	}
}
