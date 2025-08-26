<?php

namespace Castlegate\Schema\OptionsPage;

class Organization extends OptionsPage
{
    /**
     * Options page name
     *
     * @var string
     */
    protected $title = 'Organization';

    /**
     * Custom field parameters
     *
     * @var array
     */
    protected $fieldArgs = [
        'fields' => [
            [
                'key' => 'cgit_wp_schema_organization_name',
                'name' => 'organization_name',
                'label' => 'Organization name',
                'type' => 'text',
            ],

            [
                'key' => 'cgit_wp_schema_organization_description',
                'name' => 'organization_description',
                'label' => 'Organization description',
                'type' => 'textarea',
                'wrapper' => ['width' => 50],
            ],

            [
                'key' => 'cgit_wp_schema_organization_address',
                'name' => 'organization_address',
                'label' => 'Organization address',
                'type' => 'textarea',
                'wrapper' => ['width' => 50],
            ],

            [
                'key' => 'cgit_wp_schema_organization_type',
                'name' => 'organization_type',
                'label' => 'Organization type',
                'type' => 'select',
                'wrapper' => ['width' => 100],
                'choices' => [
                    'Organization' => 'Default',
                    'Corporation' => 'Corporation',
                    'EducationalOrganization' => 'EducationalOrganization',
                    'GovernmentOrganization' => 'GovernmentOrganization',
                    'LocalBusiness' => 'LocalBusiness',
                    'AnimalShelter' => '&mdash; AnimalShelter',
                    'AutomotiveBusiness' => '&mdash; AutomotiveBusiness',
                    'ChildCare' => '&mdash; ChildCare',
                    'DryCleaningOrLaundry' => '&mdash; DryCleaningOrLaundry',
                    'EmergencyService' => '&mdash; EmergencyService',
                    'EmploymentAgency' => '&mdash; EmploymentAgency',
                    'EntertainmentBusiness' => '&mdash; EntertainmentBusiness',
                    'FinancialService' => '&mdash; FinancialService',
                    'FoodEstablishment' => '&mdash; FoodEstablishment',
                    'GovernmentOffice' => '&mdash; GovernmentOffice',
                    'PostOffice' => '&mdash; &mdash; PostOffice',
                    'HealthAndBeautyBusiness' => '&mdash; HealthAndBeautyBusiness',
                    'HomeAndConstructionBusiness' => '&mdash; HomeAndConstructionBusiness',
                    'LegalService' => '&mdash; LegalService',
                    'Library' => '&mdash; Library',
                    'LodgingBusiness' => '&mdash; LodgingBusiness',
                    'BedAndBreakfast' => '&mdash; &mdash; BedAndBreakfast',
                    'Campground' => '&mdash; &mdash; Campground',
                    'Hostel' => '&mdash; &mdash; Hostel',
                    'Hotel' => '&mdash; &mdash; Hotel',
                    'Motel' => '&mdash; &mdash; Motel',
                    'Resort' => '&mdash; &mdash; Resort',
                    'ProfessionalService' => '&mdash; ProfessionalService',
                    'RadioStation' => '&mdash; RadioStation',
                    'RealEstateAgent' => '&mdash; RealEstateAgent',
                    'RecyclingCenter' => '&mdash; RecyclingCenter',
                    'SelfStorage' => '&mdash; SelfStorage',
                    'ShoppingCenter' => '&mdash; ShoppingCenter',
                    'SportsActivityLocation' => '&mdash; SportsActivityLocation',
                    'Store' => '&mdash; Store',
                    'AutoPartsStore' => '&mdash; &mdash; AutoPartsStore',
                    'BikeStore' => '&mdash; &mdash; BikeStore',
                    'BookStore' => '&mdash; &mdash; BookStore',
                    'ClothingStore' => '&mdash; &mdash; ClothingStore',
                    'ComputerStore' => '&mdash; &mdash; ComputerStore',
                    'ConvenienceStore' => '&mdash; &mdash; ConvenienceStore',
                    'DepartmentStore' => '&mdash; &mdash; DepartmentStore',
                    'ElectronicsStore' => '&mdash; &mdash; ElectronicsStore',
                    'Florist' => '&mdash; &mdash; Florist',
                    'FurnitureStore' => '&mdash; &mdash; FurnitureStore',
                    'GardenStore' => '&mdash; &mdash; GardenStore',
                    'GroceryStore' => '&mdash; &mdash; GroceryStore',
                    'HardwareStore' => '&mdash; &mdash; HardwareStore',
                    'HobbyShop' => '&mdash; &mdash; HobbyShop',
                    'HomeGoodsStore' => '&mdash; &mdash; HomeGoodsStore',
                    'JewelryStore' => '&mdash; &mdash; JewelryStore',
                    'LiquorStore' => '&mdash; &mdash; LiquorStore',
                    'MensClothingStore' => '&mdash; &mdash; MensClothingStore',
                    'MobilePhoneStore' => '&mdash; &mdash; MobilePhoneStore',
                    'MovieRentalStore' => '&mdash; &mdash; MovieRentalStore',
                    'MusicStore' => '&mdash; &mdash; MusicStore',
                    'OfficeEquipmentStore' => '&mdash; &mdash; OfficeEquipmentStore',
                    'OutletStore' => '&mdash; &mdash; OutletStore',
                    'PawnShop' => '&mdash; &mdash; PawnShop',
                    'PetStore' => '&mdash; &mdash; PetStore',
                    'ShoeStore' => '&mdash; &mdash; ShoeStore',
                    'SportingGoodsStore' => '&mdash; &mdash; SportingGoodsStore',
                    'TireShop' => '&mdash; &mdash; TireShop',
                    'ToyStore' => '&mdash; &mdash; ToyStore',
                    'WholesaleStore' => '&mdash; &mdash; WholesaleStore',
                    'TelevisionStation' => '&mdash; TelevisionStation',
                    'TouristInformationCenter' => '&mdash; TouristInformationCenter',
                    'TravelAgency' => '&mdash; TravelAgency',
                    'MedicalOrganization' => 'MedicalOrganization',
                    'Dentist' => '&mdash; Dentist',
                    'Hospital' => '&mdash; Hospital',
                    'Pharmacy' => '&mdash; Pharmacy',
                    'Physician' => '&mdash; Physician',
                    'NGO' => 'NGO',
                    'PerformingGroup' => 'PerformingGroup',
                    'SportsOrganization' => 'SportsOrganization',
                ],
            ],

            [
                'key' => 'cgit_wp_schema_organization_tel',
                'name' => 'organization_tel',
                'label' => 'Telephone number',
                'type' => 'text',
                'wrapper' => ['width' => 50],
            ],

            [
                'key' => 'cgit_wp_schema_organization_fax',
                'name' => 'organization_fax',
                'label' => 'Fax number',
                'type' => 'text',
                'wrapper' => ['width' => 50],
            ],

            [
                'key' => 'cgit_wp_schema_organization_email',
                'name' => 'organization_email',
                'label' => 'Email address',
                'type' => 'text',
                'wrapper' => ['width' => 50],
                'instructions' => 'This email address will be visible to search engines and the public internet and may attract spam messages.',
            ],

            [
                'key' => 'cgit_wp_schema_organization_logo',
                'name' => 'organization_logo',
                'label' => 'Logo',
                'type' => 'image',
                'wrapper' => ['width' => 50],
            ],

            [
                'key' => 'cgit_wp_schema_organization_image',
                'name' => 'organization_image',
                'label' => 'Image',
                'type' => 'image',
                'wrapper' => ['width' => 50],
            ],

            [
                'key' => 'cgit_wp_schema_organization_location',
                'name' => 'organization_location',
                'label' => 'Location',
                'type' => 'google_map',
                'wrapper' => ['width' => 50],
            ],

            [
                'key' => 'cgit_wp_schema_organization_hours',
                'name' => 'organization_hours',
                'label' => 'Opening hours',
                'type' => 'repeater',
                'wrapper' => ['width' => 50],
                'button_label' => 'Add Opening Hours',
                'layout' => 'block',
                'sub_fields' => [
                    [
                        'key' => 'cgit_wp_schema_organization_hours_days',
                        'name' => 'days',
                        'label' => 'Days',
                        'type' => 'select',
                        'multiple' => true,
                        'choices' => [
                            'Monday' => 'Monday',
                            'Tuesday' => 'Tuesday',
                            'Wednesday' => 'Wednesday',
                            'Thursday' => 'Thursday',
                            'Friday' => 'Friday',
                            'Saturday' => 'Saturday',
                            'Sunday' => 'Sunday',
                        ],
                    ],
                    [
                        'key' => 'cgit_wp_schema_organization_hours_opens',
                        'name' => 'opens',
                        'label' => 'Opens',
                        'type' => 'time_picker',
                        'return_format' => 'H:i',
                    ],
                    [
                        'key' => 'cgit_wp_schema_organization_hours_closes',
                        'name' => 'closes',
                        'label' => 'Closes',
                        'type' => 'time_picker',
                        'return_format' => 'H:i',
                    ],
                ],
            ],

            [
                'key' => 'cgit_wp_schema_organization_facebook_url',
                'name' => 'organization_facebook_url',
                'label' => 'Facebook URL',
                'type' => 'text',
                'wrapper' => ['width' => 50],
            ],

            [
                'key' => 'cgit_wp_schema_organization_google_url',
                'name' => 'organization_google_url',
                'label' => 'Google Plus URL',
                'type' => 'text',
                'wrapper' => ['width' => 50],
            ],

            [
                'key' => 'cgit_wp_schema_organization_instagram_url',
                'name' => 'organization_instagram_url',
                'label' => 'Instagram URL',
                'type' => 'text',
                'wrapper' => ['width' => 50],
            ],

            [
                'key' => 'cgit_wp_schema_organization_linkedin_url',
                'name' => 'organization_linkedin_url',
                'label' => 'LinkedIn URL',
                'type' => 'text',
                'wrapper' => ['width' => 50],
            ],

            [
                'key' => 'cgit_wp_schema_organization_twitter_url',
                'name' => 'organization_twitter_url',
                'label' => 'Twitter URL',
                'type' => 'text',
                'wrapper' => ['width' => 50],
            ],

            [
                'key' => 'cgit_wp_schema_organization_youtube_url',
                'name' => 'organization_youtube_url',
                'label' => 'YouTube URL',
                'type' => 'text',
                'wrapper' => ['width' => 50],
            ],
        ],
    ];
}
