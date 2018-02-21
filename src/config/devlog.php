<?php

return [
    'next_version_file' => database_path("migrations/devlog_next_version.json"),
    // Parameters for the creation of the versions table
    'versions' => [
        // Name of the table
        'table' => 'devlog_versions',

        // Name of the field for the version id
        'id' => 'id',

        // Name of the field for the version code, using Semantic Versioning (semver.org) is recommended
        'code' => 'code',
        // Size of the version code field
        'code_size' => 12,

        // Name of the field for the release date of the version
        'release_date' => 'release_date',

        // Name of the field for the short name/description of the version
        'description' => 'description',
        // Size of the description field, it's recommended to keep it very short
        'description_size' => 50,

        // If timestamp fields (created_at and updated_at) should be created
        // Useful to keep track of when the migration with each version was run
        'timestamps?' => true,

        // Name of the Model for the versions
        'model' => 'Devlog\Models\DevlogVersion'
    ],

    // Parameters for the creation of the changes table
    'changes' => [
        // Name of the table
        'table' => 'devlog_changes',

        // Name of the field for the change if
        'id' => 'id',

        // Name of the field for the foreign key reference to the version id
        'version_id' => 'version_id',

        // Name of the field for the description of the change
        'description' => 'description',

        // Size of the description field, it's recommended to don't make it short
        'description_size' => 120,

        // If timestamp fields (created_at and updated_at) should be created
        // Useful to know if any modifications were added to this version after the release date
        'timestamps?' => false,

        // Name of the Model for the changes
        'model' => 'Devlog\Models\DevlogChange'
    ]
];
