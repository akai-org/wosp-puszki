import cloudscraper
import json

scraper = cloudscraper.create_scraper()
text = scraper.get("https://eskarbonka.wosp.org.pl/wetydonike/stats").text
data = json.loads(text)

print(data["amount"])
