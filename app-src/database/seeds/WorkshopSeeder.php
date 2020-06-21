<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class WorkshopSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $data = [
        [
          'user_id' => 1,
          'name' => 'Agile Integrations - Citizen Integrator',
          'curriculum_slug' => 'agile_integrations_ci',
          'curriculum_endpoint' => 'https://redhatgov.io/workshops/',
          'typical_length_in_hours' => 8.00,
          'description' => 'The Agile Integration Workshop teaches the development, testing, and deployment of cloud-native and connected solutions. You will walk through an API Development and Agile Integration process leveraging OpenShift, Apicurio, Microcks, Fuse, and 3scale for a sample application.'
        ],
        [
          'user_id' => 1,
          'name' => 'Agile Integrations - Developer',
          'curriculum_slug' => 'agile_integrations_dev',
          'curriculum_endpoint' => 'https://redhatgov.io/workshops/',
          'typical_length_in_hours' => 8.00,
          'description' => 'The Agile Integration Workshop teaches the development, testing, and deployment of cloud-native and connected solutions. You will walk through an API Development and Agile Integration process leveraging OpenShift, Apicurio, Microcks, Fuse, and 3scale for a sample application.'
        ],
        [
          'user_id' => 1,
          'name' => 'Ansible Automation',
          'curriculum_slug' => 'ansible_automation',
          'curriculum_endpoint' => 'https://redhatgov.io/workshops/',
          'typical_length_in_hours' => 8.00,
          'description' => 'Ansible Tower will enable you to create playbooks, while building in security. Automation features will save time, empower junior staff, offload senior staff and automate your most tedious tasks!'
        ],
        [
          'user_id' => 1,
          'name' => 'Ansible Automation for Networking',
          'curriculum_slug' => 'ansible_networking',
          'curriculum_endpoint' => 'https://redhatgov.io/workshops/',
          'typical_length_in_hours' => 8.00,
          'description' => 'Ansible Tower will enable you to create playbooks, while building in security. Automation features will save time, empower junior staff, offload senior staff and automate your most tedious tasks!'
        ],
        [
          'user_id' => 1,
          'name' => 'Container Security',
          'curriculum_slug' => 'security_containers',
          'curriculum_endpoint' => 'https://redhatgov.io/workshops/',
          'typical_length_in_hours' => 8.00,
          'description' => 'Learn how to scan, secure and leverage properties in the Linux kernel like seccomp, namespaces, ccgroups to secure your docker containers.'
        ],
        [
          'user_id' => 1,
          'name' => 'Containers 101',
          'curriculum_slug' => 'containers_101',
          'curriculum_endpoint' => 'https://redhatgov.io/workshops/',
          'typical_length_in_hours' => 8.00,
          'description' => 'This workshop will introduce you to Linux containers and provide you with foundational container hands-on training.'
        ],
        [
          'user_id' => 1,
          'name' => 'Secure Software Factory',
          'curriculum_slug' => 'secure_software_factory',
          'curriculum_endpoint' => 'https://redhatgov.io/workshops/',
          'typical_length_in_hours' => 8.00,
          'description' => "In this workshop, you'll be building a Secure Software Factory for a Java based website leveraging several containerized tools such as Gogs, Nexus, Jenkins, Sonarqube, and Che hosted on the OpenShift Container Platform"
        ],
        [
          'user_id' => 1,
          'name' => 'Linux Containers the Hard Way',
          'curriculum_slug' => 'containers_the_hard_way',
          'curriculum_endpoint' => 'https://redhatgov.io/workshops/',
          'typical_length_in_hours' => 8.00,
          'description' => 'This workshop will deep dive into the Linux internals that enable containers to work. Containers will be demystified so developers and admins will have a better grasp at what their favorite container engine is doing at runtime.'
        ],
        [
          'user_id' => 1,
          'name' => 'OpenShift 101 - DC Metro Map',
          'curriculum_slug' => 'openshift_101_dcmetromap',
          'curriculum_endpoint' => 'https://redhatgov.io/workshops/',
          'typical_length_in_hours' => 8.00,
          'description' => "This workshop will have you deploying and creating native docker images for a Node.js based website and learning to leverage the power of OpenShift to build, deploy, scale, and automate."
        ],
        [
          'user_id' => 1,
          'name' => 'OpenShift 4 101',
          'curriculum_slug' => 'openshift_4_101',
          'curriculum_endpoint' => 'https://redhatgov.io/workshops/',
          'typical_length_in_hours' => 8.00,
          'description' => "This workshop will have you deploying and creating native docker images for a Node.js based website and learning to leverage the power of OpenShift 4 to build, deploy, scale, and automate."
        ],
        [
          'user_id' => 1,
          'name' => 'OpenShift Security',
          'curriculum_slug' => 'security_openshift',
          'curriculum_endpoint' => 'https://redhatgov.io/workshops/',
          'typical_length_in_hours' => 8.00,
          'description' => "Learn about secrets and how to Secure your microservices and containers by using and extending Linux scanning features, SCC, Seccomp and the security API."
        ],
        [
          'user_id' => 1,
          'name' => 'OpenShift Service Mesh',
          'curriculum_slug' => 'openshift_service_mesh',
          'curriculum_endpoint' => 'https://redhatgov.io/workshops/',
          'typical_length_in_hours' => 8.00,
          'description' => "As modern applications move toward microservices based architectures the importance of a platform to back both development and operational work grows. Development teams struggle with building, debugging, and connecting services properly. And application operations teams face increasing challenges with hybrid deployments, scaling bottlenecks, recovering from failure, and gathering metrics. Red Hat’s OpenShift Service Mesh lets you connect, secure, control, and observe your microservice based applications."
        ],
        [
          'user_id' => 1,
          'name' => 'Red Hat Enterprise Linux 8',
          'curriculum_slug' => 'rhel_8',
          'curriculum_endpoint' => 'https://redhatgov.io/workshops/',
          'typical_length_in_hours' => 8.00,
          'description' => "This workshop will cover the features, specifications and improvements that comprise the release of Red Hat Enterprise Linux Version 8 (RHEL 8)."
        ],
        [
          'user_id' => 1,
          'name' => 'SELinux Policy',
          'curriculum_slug' => 'selinux_policy',
          'curriculum_endpoint' => 'https://redhatgov.io/workshops/',
          'typical_length_in_hours' => 8.00,
          'description' => "Writing your own SELinux policies doesn’t have to be a terrifying prospect! This workshop will walk you through the process of creating a custom policy for a source-compiled application, using the advanced tooling present in Red Hat Enterprise Linux."
        ],

      ];

      foreach ($data as $workshop) {

        echo 'Adding Workshop: ' . $workshop['name'] . "...\n";
        DB::table('workshops')->insert([
          'name' => $workshop['name'],
          'created_at' => Carbon::now()->toDateTimeString(),
          'updated_at' => Carbon::now()->toDateTimeString(),
          'slug' => Str::slug($workshop['name']),
          'description' => $workshop['description'],
          'curriculum_slug' => $workshop['curriculum_slug'],
          'curriculum_endpoint' => $workshop['curriculum_endpoint'],
          'typical_length_in_hours' => $workshop['typical_length_in_hours'],
          'user_id' => $workshop['user_id'],
        ]);
      }

    }
}
