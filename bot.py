from discord.ext import commands
import discord
import re
import pydash as _

token = "--token--"
client = commands.Bot("", self_bot=True)

mudae_id = 432610292342587392
self_id = 666824224060473367
channel_id = 986094173587386370 #mudae_gallery
#channel_id = 912904428112195624 #dev

re_rank = "\*\*#(\d+)\*\*"
re_name = "- (.+) -"
re_link = "https:.+\.png"
re_kake = " (\d+) ka"
#re_full = "\*\*#(\d+)\*\*| - (.+) - |(https:.+\.png)"
re_full = "\*\*(#\d+)\*\* - (.+) \*\*(\d+)\*\* ka - <(https:.+.png)>"


@client.event
async def on_ready():
    print("Bot ready!")

@client.event
async def on_message(message):
    
    if message.author.id == self_id: #is self
        #print('message from self, ignoreing.')
        return

    if message.channel.id == channel_id: #is specified channel
        await message.channel.send(f'$mmrki-s <@{message.author.id}>')
        #await message.channel.send('Generando tu galeria, por favor espere...')
        return

    if message.author.id == mudae_id: #is mudae
        #print('message from mudae.')
        
        if isinstance(message.channel, discord.channel.DMChannel): #is direct message
            
            first_line = message.content.split('\n')[0]
            user_name = re.findall("__(.+)'s harem__", first_line)
            
            if len(user_name) != 0:
                user_name = user_name[0]
                print(f'generating {user_name}\'s gallery...')
                
                content_first_block = '\n'.join(message.content.split('\n')[5:])

                harem_list = content_first_block

                # for character in content_first_block:
                #     rank = re.findall(re_rank, character)[0]
                #     name = re.findall(re_name, character)[0]
                #     link = re.findall(re_link, character)[0]
                #     print(f'{rank} % {name} % {link}')

                #print(f'\n{content_first_block}')
                
                # f = open(f'{user_name}.mudae', 'w')
                # f.write(content_first_block)
                #f.close()

                while True:
                    
                    try:
                        msg = await client.wait_for('message', check=lambda message: message.author.id == mudae_id, timeout=3)      
                    except:
                        break
                    
                    harem_list += f'\n{msg.content}'
       
                last_iteration = ''
                last_list = harem_list.split("\n")

                for item in last_list:

                    result = re.findall(re_full, item)
                    # print(item)
                    # print(result)
                    try:
                        last_iteration += f'{result[0][0]}%{result[0][1]}%{result[0][2]}%{result[0][3]}\n'
                    except:
                        pass

                #print(last_iteration)

                f = open(f'/var/www/nimrodsolutions/public_html/mudae/userdata/{_.camel_case(user_name)}.mudae', 'w')
                f.write(last_iteration)
                f.close()

                mudae_channel = client.get_channel(channel_id)
                print(f'{user_name}\'s gallery is ready -> http://eliterust.xyz/mudae/index.php?user={_.camel_case(user_name)}')
                await mudae_channel.send(f'**{user_name}** tu galeria esta lista -> http://eliterust.xyz/mudae/index.php?user={_.camel_case(user_name)}')

        return

client.run(token, bot=False)