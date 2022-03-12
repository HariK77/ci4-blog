<?php

namespace App\Database\Seeds;

use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use CodeIgniter\Database\Seeder;
use Faker\Factory;

class PostSeeder extends Seeder
{
    public function run()
    {
        helper('basic');

        $userModel = new User();
        $userIds = $userModel->select('id')->findAll();
        $userIds = array_column($userIds, 'id');

        $categoryModel = new Category();
        $categories = $categoryModel->select('id, name')->findAll();
        $categoryIds = array_column($categories, 'id');
        $categoryNames = array_column($categories, 'name');

        $model = new Post();
        for ($i = 0; $i < 500; $i++) {
            $model->insert($this->generatePost($userIds, $categoryIds, $categoryNames));
        }
    }

    private function generatePost($userIds, $categoryIds, $categoryNames): array
    {
        $faker = Factory::create();

        $randomIndex = rand(0, count($categoryIds) - 1);
        $categoryId = $categoryIds[$randomIndex];
        $categoryName = strtolower($categoryNames[$randomIndex]);
        $title = $this->generateTitleRelatedToCategory($categoryName);

        $postContent = "<p>Never in all their history have men been able truly to conceive of the world as one: a single sphere, a globe, having the qualities of a globe, a round earth in which all the directions eventually meet, in which there is no center because every point, or none, is center — an equal earth which all men occupy as equals. The airman's earth, if free men make it, will be truly round: a globe in practice, not in theory.</p><p>Science cuts two ways, of course; its products can be used for both good and evil. But there's no turning back from science. The early warnings about technological dangers also come from science.</p><p>What was most significant about the lunar voyage was not that man set foot on the Moon but that they set eye on the earth.</p><p>A Chinese tale tells of some men sent to harm a young girl who, upon seeing her beauty, become her protectors rather than her violators. That's how I felt seeing the Earth for the first time. I could not help but love and cherish her.</p><p>For those who have seen the Earth from space, and for the hundreds and perhaps thousands more who will, the experience most certainly changes your perspective. The things that we share in our world are far more valuable than those which divide us.</p><h2><strong>The Final Frontier</strong></h2><p>There can be no thought of finishing for ‘aiming for the stars.’ Both figuratively and literally, it is a task to occupy the generations. And no matter how much progress one makes, there is always the thrill of just beginning.</p><p>There can be no thought of finishing for ‘aiming for the stars.’ Both figuratively and literally, it is a task to occupy the generations. And no matter how much progress one makes, there is always the thrill of just beginning.</p><blockquote><p><i>The dreams of yesterday are the hopes of today and the reality of tomorrow. Science has not yet mastered prophecy. We predict too much for the next year and yet far too little for the next ten.</i></p></blockquote><p>Spaceflights cannot be stopped. This is not the work of any one man or even a group of men. It is a historical process which mankind is carrying out in accordance with the natural laws of human development.</p><h2><strong>Reaching for the Stars</strong></h2><p>As we got further and further away, it [the Earth] diminished in size. Finally it shrank to the size of a marble, the most beautiful you can imagine. That beautiful, warm, living object looked so fragile, so delicate, that if you touched it with a finger it would crumble and fall apart. Seeing this has to change a man.</p><p><a href=\"". base_url(slug($title)) ."\"><img class=\"img-fluid\" src=\"". base_url($this->getImageRelatedToCategory($categoryName)) ."\" alt=\"...\"></a></p><p><i>To go places and do things that have never been done before – that’s what living is all about.</i></p><p>Space, the final frontier. These are the voyages of the Starship Enterprise. Its five-year mission: to explore strange new worlds, to seek out new life and new civilizations, to boldly go where no man has gone before.</p><p>As I stand out here in the wonders of the unknown at Hadley, I sort of realize there’s a fundamental truth to our nature, Man must explore, and this is exploration at its greatest.</p><p>Placeholder text by <a href=\"http://spaceipsum.com/\">Space Ipsum</a> · Images by <a href=\"". base_url() ."\">NASA on The Commons</a></p>";
        $date = $faker->dateTimeBetween('-2 years', 'now');
        // odd($date->date);
        $record = [
            'id_user' => $userIds[rand(0, count($userIds) - 1)],
            'id_category' => $categoryId,
            'title' => $title,
            'mini_title' => $title,
            'slug' => slug($title),
            'post_content' => $postContent,
            'header_image' => $this->getImageRelatedToCategory($categoryName),
            'created_at' => $date->format('Y-m-d H:i:s'),
            'updated_at' => $date->format('Y-m-d H:i:s'),
        ];
        // odd($record);
        return $record;

    }

    private function generateTitleRelatedToCategory($categoryName): string
    {
        $titleList = array(
            'technology' => array(
                '14 Questions You Might Be Afraid to Ask About Technology',
                '10 Situations When You\'ll Need to Know About Technology',
                'How to Outsmart Your Peers on Technology',
                'A Trip Back in Time: How People Talked About Technology 20 Years Ago',
                '10 Best Facebook Pages of All Time About Technology',
                'How to Outsmart Your Boss on Technology',
                'This Is Your Brain on Technology',
                'Technology: Expectations vs. Reality',
                '7 Horrible Mistakes You\'re Making With Technology',
                '7 Little Changes That\'ll Make a Big Difference With Your Technology',
            ),
            'nature' => array(
                '4 Dirty Little Secrets About the Nature Industry',
                'The Best Advice You Could Ever Get About Nature',
                '20 Reasons You Need to Stop Stressing About Nature',
                'Nature Explained in Instagram Photos',
                'Enough Already! 15 Things About Nature We\'re Tired of Hearing',
                '11 Embarrassing Nature Faux Pas You Better Not Make',
                'The Most Underrated Companies to Follow in the Nature Industry',
                'What I Wish I Knew a Year Ago About Nature',
                'How Much Should You Be Spending on Nature?',
                '20 Resources That\'ll Make You Better at Nature',
            ),
            'space' => array(
                '8 Effective Space Elevator Pitches',
                'The Evolution of Space',
                'The Best Advice You Could Ever Get About Space',
                '10 Things You Learned in Preschool That\'ll Help You With Space',
                'What the Oxford English Dictionary Doesn\'t Tell You About Space',
                '15 Best Pinterest Boards of All Time About Space',
                'Don\'t Make This Silly Mistake With Your Space',
                '10 Signs You Should Invest in Space',
                '5 Real-Life Lessons About Space',
                'The Biggest Problem With Space, And How You Can Fix It'
            ),
            'health' => array(
                'Sage Advice About Health From a Five-Year-Old',
                'What\'s the Current Job Market for Health Professionals Like?',
                'Responsible for a Health Budget? 10 Terrible Ways to Spend Your Money',
                'The 12 Best Health Accounts to Follow on Twitter',
                'A Look Into the Future: What Will the Health Industry Look Like in 10 Years?',
                'Health: 11 Thing You\'re Forgetting to Do',
                '15 Hilarious Videos About Health',
                'Health: What No One Is Talking About',
                'Responsible for a Health Budget? 12 Top Notch Ways to Spend Your Money',
                'Why Nobody Cares About Health',
            ),
            'financial' => array(
                '20 Questions You Should Always Ask About Financial Before Buying It',
                'How the 10 Worst Financial Fails of All Time Could Have Been Prevented',
                'Why People Love to Hate Financial',
                'The 12 Best Financial Accounts to Follow on Twitter',
                '10 Apps to Help You Manage Your Financial',
                'Financial: 11 Thing You\'re Forgetting to Do',
                'Miley Cyrus and Financial: 10 Surprising Things They Have in Common',
                'Don\'t Make This Silly Mistake With Your Financial',
                '8 Go-To Resources About Financial',
                '11 Ways to Completely Revamp Your Financial',
            ),
            'crypto' => array(
                '14 Cartoons About Crypto That\'ll Brighten Your Day',
                'How to Outsmart Your Boss on Crypto',
                '10 Quick Tips About Crypto',
                '15 Up-and-Coming Crypto Bloggers You Need to Watch',
                'How to Explain Crypto to Your Grandparents',
                '5 Lessons About Crypto You Can Learn From Superheroes',
                'Crypto: Expectations vs. Reality',
                'Don\'t Make This Silly Mistake With Your Crypto',
                '10 Compelling Reasons Why You Need Crypto',
                '12 Reasons You Shouldn\'t Invest in Crypto',
            ),
            'fashion' => array(
                '10 Meetups About Fashion You Should Attend',
                'What I Wish I Knew a Year Ago About Fashion',
                'Fashion: All the Stats, Facts, and Data You\'ll Ever Need to Know',
                '12 Stats About Fashion to Make You Look Smart Around the Water Cooler',
                'The Advanced Guide to Fashion',
                '20 Things You Should Know About Fashion',
                '17 Superstars We\'d Love to Recruit for Our Fashion Team',
                '15 Reasons Why You Shouldn\'t Ignore Fashion',
                '5 Laws Anyone Working in Fashion Should Know',
                '10 Things We All Hate About Fashion',
            ),
            'react' => array(
                'The Ultimate Guide to React Js',
                '15 Most Underrated Skills That\'ll Make You a Rockstar in the React Js Industry',
                '15 Up-and-Coming React Js Bloggers You Need to Watch',
                'What I Wish I Knew a Year Ago About React Js',
                'The Most Influential People in the React Js Industry and Their Celebrity Dopplegangers',
                '10 Things Most People Don\'t Know About React Js',
                '10 Pinterest Accounts to Follow About React Js',
                '20 Resources That\'ll Make You Better at React Js',
                'Meet the Steve Jobs of the React Js Industry',
                '13 Things About React Js You May Not Have Known',
            ),
            'javascript' => array(
                'The Most Common Mistakes People Make With Javascript',
                'The Most Pervasive Problems in Javascript',
                '25 Surprising Facts About Javascript',
                'Why People Love to Hate Javascript',
                'The 3 Biggest Disasters in Javascript History',
                'A Productive Rant About Javascript',
                '10 Things Most People Don\'t Know About Javascript',
                '15 Secretly Funny People Working in Javascript',
                'What\'s Holding Back the Javascript Industry?',
                '7 Little Changes That\'ll Make a Big Difference With Your Javascript',
            ),
            'php' => array(
                'Forget Php Programming: 10 Reasons Why You No Longer Need It',
                '12 Stats About Php Programming to Make You Look Smart Around the Water Cooler',
                'Why the Biggest "Myths" About Php Programming May Actually Be Right',
                '10 Things Steve Jobs Can Teach Us About Php Programming',
                'The Worst Advice We\'ve Ever Heard About Php Programming',
                'The Most Innovative Things Happening With Php Programming',
                'No Time? No Money? No Problem! How You Can Get Php Programming With a Zero-Dollar Budget',
                '10 Principles of Psychology You Can Use to Improve Your Php Programming',
                'The 17 Most Misunderstood Facts About Php Programming',
                '15 Things Your Boss Wishes You Knew About Php Programming',
            ),
            'laravel' => array(
                '15 People You Oughta Know in the Laravel Industry',
                '10 Quick Tips About Laravel',
                'Is Tech Making Laravel Better or Worse?',
                'The Most Common Complaints About Laravel, and Why They\'re Bunk',
                'How to Explain Laravel to Your Boss',
                'How Much Should You Be Spending on Laravel?',
                'Laravel: It\'s Not as Difficult as You Think',
                '20 Fun Facts About Laravel',
                '15 Best Twitter Accounts to Learn About Laravel',
                'How to Get Hired in the Laravel Industry',
            ),
            'codeigniter' => array(
                '10 Best Facebook Pages of All Time About Codeigniter Framework',
                '3 Reasons Your Codeigniter Framework Is Broken (And How to Fix It)',
                'The Codeigniter Framework Awards: The Best, Worst, and Weirdest Things We\'ve Seen',
                'Forget Codeigniter Framework: 10 Reasons Why You No Longer Need It',
                'A Productive Rant About Codeigniter Framework',
                'Getting Tired of Codeigniter Framework? 10 Sources of Inspiration That\'ll Rekindle Your Love',
                'How to Explain Codeigniter Framework to Your Mom',
                'How Technology Is Changing How We Treat Codeigniter Framework',
                'The Next Big Thing in Codeigniter Framework',
                '15 Hilarious Videos About Codeigniter Framework',
            ),
            'symfony' => array(
                'The Most Pervasive Problems in Symfony',
                '5 Killer Quora Answers on Symfony',
                'The Ultimate Glossary of Terms About Symfony',
                'The Ugly Truth About Symfony',
                '10 Inspirational Graphics About Symfony',
                'Undeniable Proof That You Need Symfony',
                'Symfony: 11 Thing You\'re Forgetting to Do',
                '10 Things You Learned in Kindergarden That\'ll Help You With Symfony',
                'How to Solve Issues With Symfony',
                '24 Hours to Improving Symfony',
            ),
        );

        $title = $titleList[$categoryName][rand(0, count($titleList[$categoryName]) - 1)];
        return $title;
    }

    private function getImageRelatedToCategory($categoryName): string
    {
        $imageList = array(
            'technology' => array(
                'app/img/posts/technology/1.jpg',
                'app/img/posts/technology/2.jpg',
                'app/img/posts/technology/3.jpg',
                'app/img/posts/technology/4.jpg',
                'app/img/posts/technology/5.jpg',
                'app/img/posts/technology/6.jpg',
                'app/img/posts/technology/7.jpg',
                'app/img/posts/technology/8.jpg',
                'app/img/posts/technology/9.jpg',
                'app/img/posts/technology/10.jpg',
            ),
            'nature' => array(
                'app/img/posts/nature/1.jpg',
                'app/img/posts/nature/2.jpg',
                'app/img/posts/nature/3.jpg',
                'app/img/posts/nature/4.jpg',
                'app/img/posts/nature/5.jpg',
                'app/img/posts/nature/6.jpg',
                'app/img/posts/nature/7.jpg',
                'app/img/posts/nature/8.jpg',
                'app/img/posts/nature/9.jpg',
            ),
            'space' => array(
                'app/img/posts/space/1.jpg',
                'app/img/posts/space/2.jpg',
                'app/img/posts/space/3.jpg',
                'app/img/posts/space/4.jpg',
                'app/img/posts/space/5.jpg',
                'app/img/posts/space/6.jpg',
                'app/img/posts/space/7.jpg',
                'app/img/posts/space/8.jpg',
                'app/img/posts/space/9.jpg',
                'app/img/posts/space/10.jpg',
            ),
            'health' => array(
                'app/img/posts/health/1.jpg',
                'app/img/posts/health/2.jpg',
                'app/img/posts/health/3.jpg',
                'app/img/posts/health/4.jpg',
                'app/img/posts/health/5.jpg',
                'app/img/posts/health/6.jpg',
                'app/img/posts/health/7.jpg',
                'app/img/posts/health/8.jpg',
                'app/img/posts/health/9.jpg',
                'app/img/posts/health/10.jpg',
            ),
            'financial' => array(
                'app/img/posts/financial/1.jpg',
                'app/img/posts/financial/2.jpg',
                'app/img/posts/financial/3.jpg',
                'app/img/posts/financial/4.jpg',
                'app/img/posts/financial/5.jpg',
            ),
            'crypto' => array(
                'app/img/posts/crypto/1.jpg',
                'app/img/posts/crypto/2.jpg',
                'app/img/posts/crypto/3.jpg',
                'app/img/posts/crypto/4.jpg',
                'app/img/posts/crypto/5.jpg',
            ),
            'fashion' => array(
                'app/img/posts/fashion/1.jpg',
                'app/img/posts/fashion/2.jpg',
                'app/img/posts/fashion/3.jpg',
                'app/img/posts/fashion/4.jpg',
                'app/img/posts/fashion/5.jpg',
                'app/img/posts/fashion/6.jpg',
            ),
            'react' => array(
                'app/img/posts/react/1.jpeg',
                'app/img/posts/react/2.jpg',
                'app/img/posts/react/3.jpg',
                'app/img/posts/react/4.jpg',
                'app/img/posts/react/5.jpeg',
                'app/img/posts/react/6.jpg',
            ),
            'javascript' => array(
                'app/img/posts/javascript/1.jpg',
                'app/img/posts/javascript/2.jpg',
                'app/img/posts/javascript/3.png',
                'app/img/posts/javascript/4.jpg',
                'app/img/posts/javascript/5.png',
            ),
            'php' => array(
                'app/img/posts/php/1.jpg',
                'app/img/posts/php/2.jpg',
                'app/img/posts/php/3.jpg',
                'app/img/posts/php/4.jpg',
                'app/img/posts/php/5.jpg',
            ),
            'laravel' => array(
                'app/img/posts/laravel/1.png',
                'app/img/posts/laravel/2.jpg',
                'app/img/posts/laravel/3.jpg',
                'app/img/posts/laravel/4.jpg',
                'app/img/posts/laravel/5.jpg',
            ),
            'codeigniter' => array(
                'app/img/posts/codeigniter/1.jpg',
                'app/img/posts/codeigniter/2.png',
                'app/img/posts/codeigniter/3.png',
                'app/img/posts/codeigniter/4.png',
                'app/img/posts/codeigniter/5.png',
            ),
            'symfony' => array(
                'app/img/posts/symfony/1.png',
                'app/img/posts/symfony/2.jpeg',
                'app/img/posts/symfony/3.jpg',
                'app/img/posts/symfony/4.png',
                'app/img/posts/symfony/5.jpg',
            ),
        );
        $imgPath = $imageList[$categoryName][rand(0, count($imageList[$categoryName]) - 1)];
        return $imgPath;
    }
}
