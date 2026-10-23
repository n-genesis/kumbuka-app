<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use CodeIgniter\I18n\Time;
use Faker\Factory;

class NoteSeeder extends Seeder
{
    public function run()
    {
        $faker = Factory::create();
        $notesData = [
            [
                'id' => 1,
                'user_id' => 1,
                'slug' => 'adriang-first-note',
                'title' => 'Starting It Up!',
                'content' => "<p>So what is this all about? Well it's all for fun really. Kumbuka; fun fact (Swahili: 'to take note' or 'to remember') is a lightweight notebook and blogging web application designed for casual writing, posting and sharing. Like it says all over the site, it's meant more for fun and as a portfolio project. Feel free to mess around and create an account. It can be deleted anything. let me know what you think.</p>",
                'color' => '#00396B',
                'allow_comments' => true,
                'notebook_id' => 1,
                'created_at' => $faker->dateTimeThisMonth()->format('Y-m-d H:i:s'),
                'updated_at' => Time::yesterday(),
                'visibility' => 'public',
            ],
            [
                'id' => 2,
                'user_id' => 1,
                'slug' => 'my-second-note',
                'title' => 'Random Note',
                'content' => "<p>Just a note to post some content.</p>",
                'color' => '#00396B',
                'allow_comments' => true,
                'notebook_id' => 2,
                'created_at' => $faker->dateTimeThisMonth()->format('Y-m-d H:i:s'),
                'updated_at' => Time::yesterday(),
                'visibility' => 'private',
            ],
            [
                'id' => 3,
                'user_id' => 2,
                'slug' => 'the-best-title',
                'title' => 'The Web Tech Guy\'s Note',
                'content' => "<p>Lorem ipsum dolor sit amet consectetur adipiscing elit. Quisque faucibus ex sapien vitae pellentesque sem placerat. In id cursus mi pretium tellus duis convallis. Tempus leo eu aenean sed diam urna tempor. Pulvinar vivamus fringilla lacus nec metus bibendum egestas. Iaculis massa nisl malesuada lacinia integer nunc posuere. Ut hendrerit semper vel class aptent taciti sociosqu. Ad litora torquent per conubia nostra inceptos himenaeos.</p><p>Lorem ipsum dolor sit amet consectetur adipiscing elit. Quisque faucibus ex sapien vitae pellentesque sem placerat. In id cursus mi pretium tellus duis convallis. Tempus leo eu aenean sed diam urna tempor. Pulvinar vivamus fringilla lacus nec metus bibendum egestas. Iaculis massa nisl malesuada lacinia integer nunc posuere. Ut hendrerit semper vel class aptent taciti sociosqu. Ad litora torquent per conubia nostra inceptos himenaeos.</p><p>Lorem ipsum dolor sit amet consectetur adipiscing elit. Quisque faucibus ex sapien vitae pellentesque sem placerat. In id cursus mi pretium tellus duis convallis. Tempus leo eu aenean sed diam urna tempor. Pulvinar vivamus fringilla lacus nec metus bibendum egestas. Iaculis massa nisl malesuada lacinia integer nunc posuere. Ut hendrerit semper vel class aptent taciti sociosqu. Ad litora torquent per conubia nostra inceptos himenaeos.</p>",
                'color' => '#00396B',
                'allow_comments' => true,
                'notebook_id' => 3,
                'created_at' => $faker->dateTimeThisMonth()->format('Y-m-d H:i:s'),
                'updated_at' => Time::yesterday(),
                'visibility' => 'public',
            ],
            [
                'id' => 4,
                'user_id' => 3,
                'slug' => 'demo-note',
                'title' => 'A Demo Note for the App',
                'content' => "<p>Lorem ipsum dolor sit amet consectetur adipiscing elit. Quisque faucibus ex sapien vitae pellentesque sem placerat. In id cursus mi pretium tellus duis convallis. Tempus leo eu aenean sed diam urna tempor. Pulvinar vivamus fringilla lacus nec metus bibendum egestas. Iaculis massa nisl malesuada lacinia integer nunc posuere. Ut hendrerit semper vel class aptent taciti sociosqu. Ad litora torquent per conubia nostra inceptos himenaeos.</p><p>Lorem ipsum dolor sit amet consectetur adipiscing elit. Quisque faucibus ex sapien vitae pellentesque sem placerat. In id cursus mi pretium tellus duis convallis. Tempus leo eu aenean sed diam urna tempor. Pulvinar vivamus fringilla lacus nec metus bibendum egestas. Iaculis massa nisl malesuada lacinia integer nunc posuere. Ut hendrerit semper vel class aptent taciti sociosqu. Ad litora torquent per conubia nostra inceptos himenaeos.</p><p>Lorem ipsum dolor sit amet consectetur adipiscing elit. Quisque faucibus ex sapien vitae pellentesque sem placerat. In id cursus mi pretium tellus duis convallis. Tempus leo eu aenean sed diam urna tempor. Pulvinar vivamus fringilla lacus nec metus bibendum egestas. Iaculis massa nisl malesuada lacinia integer nunc posuere. Ut hendrerit semper vel class aptent taciti sociosqu. Ad litora torquent per conubia nostra inceptos himenaeos.</p>",
                'color' => '#00396B',
                'allow_comments' => true,
                'notebook_id' => 4,
                'created_at' => $faker->dateTimeThisMonth()->format('Y-m-d H:i:s'),
                'updated_at' => Time::yesterday(),
                'visibility' => 'public',
            ],
            [
                'id' => 5,
                'user_id' => 4,
                'slug' => 'an-article',
                'title' => 'To All the Catz',
                'content' => "<p>The neighborhood was silent, save for the rhythmic clinking of cheap ceramic bowls. Barnaby, a ginger cat with a torn left ear and a permanent scowl, sat atop the dumpster behind apartment 4B. Tonight was the night. The Great Human Shift was happening. His owner, a twenty-something graphic designer named Chloe, had packed her last box. They were moving across town.</p><p>But Barnaby had unfinished business. He couldn’t just leave without closure. He had hearts to break. He had territories to formally abdicate.</p><p>Barnaby cleared his throat, coughed up a small hairball, and began to address the alleyway.</p><p>\"To all the cats I’ve loved before,\" Barnaby meowed, his voice echoing off the brick walls.</p><p>From behind a recycling bin, a sleek black cat named Mittens stepped into the moonlight. \"Barnaby? Is it true? Are you leaving the dumpster radius?\"</p><p>\"I must, Mittens,\" Barnaby said, looking down dramatically. \"Our affair was beautiful, but unsustainable. I will always cherish the time we shared that half-eaten salmon skin behind the sushi place. But Chloe bought a house with a screened-in porch. The suburban life calls.\"</p><p>\"You promised we’d share the sunbeam on the green sedan forever!\" Mittens wailed, batting angrily at a discarded soda can.</p><p>\"The sun moves, Mittens. And so must I,\" Barnaby replied smoothly.</p><p>Suddenly, a fluffy white Persian named Duchess puffed out her chest from the fire escape. \"What about me, Barnaby? You hissed at my reflection in the puddle just last Tuesday! I thought what we had was hostile yet deeply respectful!\"</p><p>\"It was, Duchess,\" Barnaby conceded. \"Your growl will haunt my dreams. But you deserve a tomcat who isn’t restricted by an indoor-only mandate.\"</p><p>A heavy silence fell over the alley. Barnaby looked at his harem of neighborhood rivals, casual napping partners, and the one feral cat he regularly screamed at through the window. He felt a rare pang of feline emotion.</p><p>Just then, the back door creaked open. Chloe stepped out, holding a plastic pet carrier.</p><p>\"Barnaby! Come here, sweetie! Time to go to the new house!\" Chloe cooed in that high-pitched voice Barnaby secretly despised but tolerated for the premium wet food.</p><p>Barnaby looked at his subjects one last time. He gave a final, majestic meow, leaping from the dumpster directly into the carrier. He didn't want to make a scene.</p><p>As Chloe carried him away, Barnaby pressed his pink nose against the plastic mesh. He watched the alley fade into the distance, knowing he was leaving a legacy of broken hearts and knocked-over trash cans. He was ready for the suburbs. To all the cats he left behind—they would just have to find another ginger legend to obsess over.</p>",
                'color' => '#00396B',
                'allow_comments' => true,
                'notebook_id' => 5,
                'created_at' => $faker->dateTimeThisMonth()->format('Y-m-d H:i:s'),
                'updated_at' => Time::yesterday(),
                'visibility' => 'public',
            ],
            [
                'id' => 6,
                'user_id' => 4,
                'slug' => 'the-coffee-shop',
                'title' => 'The Coffee shop',
                'content' => "<p>The coffee shop smelled of burnt hazelnuts and damp wool. Clara sat by the window, her fingers tracking the rain as it streaked down the glass, blurring the neon sign of the bakery across the street. She was waiting for a man she had only ever known by his handwriting.</p>
<p>For three months, they had exchanged letters through a loose brick in the alley behind the library. No names, no addresses—just thick cream paper and blue ink. He wrote about the geometry of autumn leaves and the sound of cello strings snapping in empty rooms. She wrote about her fear of growing old too quickly and the recipe for her grandmother’s lemon cake.</p><p>The clock above the counter ticked closer to five. The agreement had been simple: if either of them ever wanted to stop writing, they would leave a final note with a time and a place to meet. Yesterday, she had found the brick dislodged. The note inside contained only four words: The Corner Cafe. Friday.</p><p>A bell chimed as the door opened. A gust of cold wind swept into the room, making the napkins flutter. Clara didn’t look up immediately. She kept her eyes fixed on the small paper crane she had folded from his last letter, resting right next to her cold cup of tea.</p><p>Is this seat taken?</p><p>The voice was lighter than she expected, but it carried the exact, slow cadence of the words she had read a dozen times over. Clara looked up and smiled.</p>",
                'color' => '#00396B',
                'allow_comments' => true,
                'notebook_id' => 5,
                'created_at' => $faker->dateTimeThisMonth()->format('Y-m-d H:i:s'),
                'updated_at' => Time::yesterday(),
                'visibility' => 'private',
            ],
            [
                'id' => 7,
                'user_id' => 4,
                'slug' => 'the-watches-final-hour',
                'title' => 'The Watches Final Hour',
                'content' => "<p>The digital display on the microwave blinked 11:59 PM, casting a cold, green glow over the kitchen counter. Inspector Barnaby Tick-Tock (self-proclaimed) adjusted his magnifying glass. His patient lay before him on a velvet cloth: a luxury, gold-plated, mechanical wristwatch.</p><p>It was a masterpiece of Swiss engineering. It was also completely dead.</p><p>\"We are entering the final hour,\" Barnaby whispered to his assistant, a golden retriever named Rolex who was currently trying to eat a dust bunny. \"If we don't fix the balance wheel by midnight, the client's husband will realize she accidentally ran it through the heavy-duty spin cycle.\"</p><p>Barnaby picked up his precision tweezers. His hands were shaking. He hadn't slept in thirty-six hours. His diet consisted entirely of stale coffee and premium watch oil.</p><p>\"Scale of one to ten, how bad is it?\" asked Sarah, bursting into the room. She was the frantic client, wearing mismatched pajamas and holding a half-empty bottle of wine.</p><p>\"It’s an eleven, Sarah,\" Barnaby snapped, not looking up. \"The mainspring is twisted like a cheap garden hose. The tourbillon looks like it went three rounds with a garbage disposal. I am performing open-heart surgery on a mechanical deity here.\"</p><p>\"Can't you just put a new battery in it?\" Sarah whimpered.</p><p>Barnaby stiffened. He slowly lowered his tweezers and looked at her with pure, unadulterated horror. \"A battery? In a Patek Philippe? Madam, you insult my ancestors. You insult the very concept of time itself. This machine runs on gravity, engineering, and the tears of perfectionists. Not lithium!\"</p><p>\"Okay, okay! Just fix it!\"</p><p>The microwave beeped. 12:00 AM.</p><p>The final hour has passed,\" Barnaby muttered, his shoulders slumping. \"It's over. Time has won.\"</p><p>Suddenly, Rolex barked loudly, slamming his heavy tail against the kitchen counter. The massive vibration shook the entire island. The velvet cloth jolted.</p><p>Tick.</p><p>Barnaby froze.</p><p>Tick. Tick. Tick.</p><p>The tiny, golden second hand shuddered, leaped forward, and began its smooth, sweeping sprint around the dial. The internal gears hummed a beautiful, rhythmic song of resurrection.</p><p>Barnaby stared in disbelief. He looked at the watch, then down at the dog.</p><p>\"Concussive maintenance,\" Barnaby whispered in awe. \"The canine kinetic jumpstart. Brilliant.\"</p><p>He picked up the perfectly functioning watch, polished it with his sleeve, and presented it to Sarah with a theatrical bow. \"That will be four hundred dollars. And fifty dollars for the lead strategist.\" He tossed a bacon treat to Rolex, who caught it out of the air. Time, once again, had been saved by the finest minds in the business.</p>",
                'color' => '#00396B',
                'allow_comments' => true,
                'notebook_id' => 5,
                'created_at' => $faker->dateTimeThisMonth()->format('Y-m-d H:i:s'),
                'updated_at' => Time::yesterday(),
                'visibility' => 'public',
            ],
            [
                'id' => 8,
                'user_id' => 4,
                'slug' => 'the-clockmakers-compass',
                'title' => 'The Clockmaker’s Compass',
                'content' => "<p>The rain in Oakhaven never just fell; it whispered. For forty years, Alistair Vance had ignored those whispers, keeping his eyes locked tightly on the intricate gears of the pocket watches he repaired. His shop smelled of brass polish, dried lavender, and old paper. He liked things that followed a precise, predictable rhythm.</p><p>Everything changed on a damp Tuesday afternoon when a young woman in a drenched trench coat left a peculiar brass compass on his counter. Before Alistair could call out to her, she vanished into the thick fog.</p><p>Unlike a normal compass, this one didn't point north. Its single, silver needle spun erratically whenever Alistair felt anxious, but slowed down to point directly at a hidden brick wall behind his own workbench whenever he breathed deeply. Intrigued, Alistair grabbed a hammer and carefully pried away the loose mortar.</p><p>Behind the wall sat a dust-covered iron box. Inside was a leather-bound journal written in his own handwriting—dated exactly thirty years into the future. The very first line read: “Alistair, if you are reading this, it means she finally brought you the compass. Do not trust the grandfather clock in the town square. It is not counting time; it is stealing it.”</p><p>As the town clock began to chime five o'clock, the echoes sounded heavier than usual, and Alistair noticed the rain outside suddenly freeze mid-air.</p>",
                'color' => '#00396B',
                'allow_comments' => true,
                'notebook_id' => 5,
                'created_at' => $faker->dateTimeThisMonth()->format('Y-m-d H:i:s'),
                'updated_at' => Time::yesterday(),
                'visibility' => 'public',
            ],
        ];

        $this->db->table('notes')->insertBatch($notesData);
    }
}
